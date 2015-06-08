<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/5/15
 * Time: 9:49 AM
 */

use Laracasts\TestDummy\Factory as TestDummy;

class AuthTest extends TestCase
{


    /**
     * @test
     */
    public function it_logs_a_user_in()
    {
        TestDummy::create('Omashu\User', ['email' => 'joe@example.com']);

        $this->visit('admin/login')
            ->andSee('login')
            ->andSubmitForm('Login', [
                'email'    => 'joe@example.com',
                'password' => 'password'
            ]);

        $this->seePageIs('admin/');
        $this->assertEquals('joe@example.com', $this->app['auth']->user()->email);
    }

    /**
     * @test
     */
    public function it_wont_log_in_unregistered_user()
    {
        $userDetails = TestDummy::attributesFor('Omashu\User');
        $userDetails['password'] = bcrypt('password');

        $this->notSeeInDatabase('users', $userDetails);

        $this->visit('admin/login')
            ->andSubmitForm('Login', [
                'email'    => $userDetails['email'],
                'password' => 'password'
            ])->andSeePageIs('admin/login');

        $this->assertNull($this->app['auth']->user(), 'User should be null');
    }

    /**
     * @test
     */
    public function it_logs_a_user_out()
    {
        $user = TestDummy::create('Omashu\User');
        $this->app['auth']->login($user);

        $this->assertTrue($this->app['auth']->check());

        $this->visit('admin/logout')
            ->andSeePageIs('/');

        $this->assertFalse($this->app['auth']->check());
    }

    /**
     * @test
     */
    public function it_allows_a_user_to_reset_their_password()
    {
        $user = TestDummy::create('Omashu\User');
        $this->app['auth']->login($user);

        $this->visit('admin/resetpassword')
            ->andSee('reset your password')
            ->andSubmitForm('Reset Password', [
                'current_password'          => 'password',
                'new_password'              => 'morris23',
                'new_password_confirmation' => 'morris23'
            ])->andSeePageIs('admin/');

        $validated = $this->app['auth']->validate(['email' => $user['email'], 'password' => 'morris23']);

        $this->assertTrue($validated, 'the user should be validated with new password');
    }

}