<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/5/15
 * Time: 9:44 AM
 */

use Laracasts\TestDummy\Factory as TestDummy;

class AdminPagesTest extends TestCase {

    /**
     * @test
     */
    public function it_shows_the_dashboard()
    {
        $user = TestDummy::create('Omashu\User');
        $this->app['auth']->login($user);
        $this->visit('admin/')->andSee('admin dashboard');
    }

    /**
     * @test
     */
    public function it_only_shows_admin_pages_to_logged_in_user()
    {
        $pages = [
            'admin/',
            'admin/register',
            'admin/logout',
        ];

        $this->assertTrue($this->app['auth']->guest(), 'User must be a guest');

        foreach($pages as $page) {
            $this->visit($page)->andNotSeePageIs($page);
        }
    }

}