<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/3/15
 * Time: 10:22 AM
 */

class PagesTest extends TestCase {

    /** @test */
    public function it_shows_the_homepage()
    {
        $this->visit('/')
            ->andSee('Omashu Home Page');
    }

}