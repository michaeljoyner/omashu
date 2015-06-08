<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/4/15
 * Time: 11:25 AM
 */

use Laracasts\TestDummy\Factory as TestDummy;

class RegistrationTest extends TestCase
{


    /**
     * @test
     */
    public function it_registers_a_new_user()
    {
        $this->loginAsRegisteredUser();
        $userData = TestDummy::attributesFor('Omashu\User');
        $formData = array_merge($userData, ['password_confirmation' => 'password']);
        $this->visit('/admin/register')
            ->andSee('Register a New User');

        $this->submitForm('Register', $formData);

        $this->seeInDatabase('users', ['name' => $userData['name'], 'email' => $userData['email']]);
    }

    /**
     * @test
     */
    public function it_wont_register_a_user_without_a_unique_email_address()
    {
        $this->loginAsRegisteredUser();
        TestDummy::create('Omashu\User', ['email' => 'joe@example.com']);

        $newUserData = TestDummy::attributesFor('Omashu\User', ['email' => 'joe@example.com']);
        $formData = array_merge($newUserData, ['password_confirmation' => 'password']);
        $this->visit('/admin/register')
            ->andSubmitForm('Register', $formData)
            ->andSeePageIs('admin/register')
            ->andSee('there were some problems with your input');
    }

    /**
     * @test
     */
    public function it_shows_all_registered_users()
    {
        foreach (range(1, 3) as $index) {
            ${'user'.$index} = TestDummy::create('Omashu\User');
        }

        $this->app['auth']->login($user1);

        $this->visit('admin/register')->andSeePageIs('admin/register');

        foreach(range(1,3) as $count) {
            $this->see(${'user'.$count}['email']);
        }
    }

    protected function loginAsRegisteredUser()
    {
        $user = TestDummy::create('Omashu\User');
        $this->app['auth']->login($user);
    }
}