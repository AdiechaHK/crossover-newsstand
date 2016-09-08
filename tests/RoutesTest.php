<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RoutesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginRoute() {
        
        $this->visit('/')
            ->click('Login')
            ->seePageIs('/login');
    }

    public function testRegisterRoute() {
        
        $this->visit('/')
            ->click('Register')
            ->seePageIs('/register_request');
    }

    public function testHomePageDontShowCreateNewBtnWithoutLogin() {
        
        $this->visit('/')
			->dontSee('Create New');
    }
    public function testHomePageDontShowLoadMoreBtnWithoutLogin() {
        $this->visit('/')
			->dontSee('Load more');
	}


}
