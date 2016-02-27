<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/4/15
 * Time: 11:25 AM
 */

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laracasts\TestDummy\Factory as TestDummy;
use Omashu\User;

class RegistrationTest extends TestCase
{

    use DatabaseMigrations;
    /**
     * @test
     */
    public function it_registers_a_new_user()
    {
        $this->asLoggedInUser();

        $this->visit('/admin/register')
            ->see('Register a New User');

        $this->submitForm('Register', [
            'name' => 'Billy the Kid',
            'email' => 'billy@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $this->seeInDatabase('users', [
            'name' => 'Billy the Kid',
            'email' => 'billy@example.com'
        ]);
    }

    /**
     * @test
     */
    public function it_wont_register_a_user_without_a_unique_email_address()
    {
        $this->asLoggedInUser(); //adds a user with email of joe@example.com
        $newUserData = [
            'name' => 'Billy the Kid',
            'email' => 'joe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $this->visit('/admin/register')
            ->submitForm('Register', $newUserData)
            ->seePageIs('admin/register')
            ->see('there were some problems with your input');
    }

    /**
     * @test
     */
    public function it_shows_all_registered_users()
    {
        $loggedInUser = $this->asLoggedInUser();
        $users = factory(User::class, 3)->create();

        $this->visit('admin/register')
            ->seePageIs('admin/register');

        $users->each(function($user) {
            $this->see($user->name);
        });
        $this->see($loggedInUser->name);
    }

    /**
     *@test
     */
    public function a_user_can_be_deleted()
    {
        $this->asLoggedInUser();

        $user = factory(User::class)->create();

        $this->withoutMiddleware();
        $response = $this->call('DELETE', '/admin/users/'.$user->id);
        $this->assertEquals(302, $response->status());

        $this->notSeeInDatabase('users', ['id' => $user->id]);
    }

    /**
     *@test
     */
    public function the_final_user_cannot_be_deleted()
    {
        $onlyUser = $this->asLoggedInUser();

        $this->withoutMiddleware();
        $response = $this->call('DELETE', '/admin/users/'.$onlyUser->id);
        $this->assertEquals(302, $response->status());

        $this->seeInDatabase('users', ['id' => $onlyUser->id]);

    }
}