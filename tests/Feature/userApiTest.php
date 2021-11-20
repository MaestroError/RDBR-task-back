<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class userApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register()
    {
        $response = $this->postJson('/api/register', 
        [
            'name' => 'ME',
            'email' => rand(1,40)."@test.com",
            "password" => "1234",
            "password_confirmation" => "1234"
        ]);

        $response
            ->assertCreated();
    }


    public function test_login()
    {
        $response = $this->postJson('/api/login', 
        [
            'email' => "revaz.gh@gmail.com",
            "password" => "password",
        ]);

        $response
            ->assertStatus(200);
    }


    public function test_logout()
    {
        $response = $this->withHeaders([
            "Accept" => "application/json"
        ])->postJson('/api/logout');

        $response
            ->assertUnauthorized();
    }
}
