<?php

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laracasts\Integrated\Services\Laravel\DatabaseTransactions;

class TestCase extends BaseTestCase
{

    use DatabaseTransactions;

    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
    }

    protected function asLoggedInUser()
    {
        $user = factory(\Omashu\User::class)->create(['password' => 'password', 'email' => 'joe@example.com']);
        $this->actingAs($user);

        return $user;
    }

}
