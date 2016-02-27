<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/5/15
 * Time: 9:49 AM
 */

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laracasts\TestDummy\Factory as TestDummy;

class AuthTest extends TestCase
{

    use DatabaseMigrations;


    /**
     * @test
     */
    public function it_logs_a_user_in()
    {
        factory(\Omashu\User::class)->create(['password' => 'password', 'email' => 'joe@example.com']);

        $this->visit('admin/login')
            ->submitForm('Login', [
                'email'    => 'joe@example.com',
                'password' => 'password'
            ])->seePageIs('admin/brands');

        $this->assertEquals('joe@example.com', $this->app['auth']->user()->email);
    }

    /**
     * @test
     */
    public function it_wont_log_in_unregistered_user()
    {
        $user = factory(\Omashu\User::class)->make(['email' => 'joe@example.com', 'password' => 'password']);


        $this->notSeeInDatabase('users', [
            'email' => $user->email
        ]);

        $this->visit('admin/login')
            ->submitForm('Login', [
                'email'    => 'joe@password.com',
                'password' => 'password'
            ])->seePageIs('admin/login');

        $this->assertNull($this->app['auth']->user(), 'User should be null');
    }

    /**
     * @test
     */
    public function it_logs_a_user_out()
    {
        $user = factory(\Omashu\User::class)->create(['password' => 'password', 'email' => 'joe@example.com']);
        $this->actingAs($user);

        $this->assertTrue($this->app['auth']->check());

        $this->visit('admin/logout')
            ->seePageIs('/');

        $this->assertFalse($this->app['auth']->check());
    }

    /**
     * @test
     */
    public function it_allows_a_user_to_reset_their_password()
    {
        $user = $this->asLoggedInUser();

        $this->visit('admin/resetpassword')
            ->submitForm('Reset Password', [
                'current_password'          => 'password',
                'new_password'              => 'morris23',
                'new_password_confirmation' => 'morris23'
            ])->seePageIs('admin/brands');

        $validated = $this->app['auth']->validate(['email' => $user['email'], 'password' => 'morris23']);

        $this->assertTrue($validated, 'the user should be validated with new password');
    }

}