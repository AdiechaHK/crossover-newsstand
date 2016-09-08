<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{

    public function testLoginSuccessfull() {

        $user = factory(App\Models\User::class)->create();
        $this->visit('/login')
			->type($user->email, 'email')
			->type('secret', 'password')
			->press('Login')
			->seePageIs('/')
			->see('Create New');

        $user->delete();
		
    }

    public function testLoginWithInvalidEmail() {
        $user = factory(App\Models\User::class)->create();

        $invalidEmail = $user->email . "invalid";

		$response = $this->call('POST', '/login', ['email' => $invalidEmail, 'password' => "secret"]);

		$this->assertHasOldInput();

        $user->delete();
		
    }


    public function testLogoutSuccessfull() {

        $user = factory(App\Models\User::class)->create();

        $this->actingAs($user)
			->delete('/logout')
			->dontSee('Create New');

        $user->delete();
		
    }


}
