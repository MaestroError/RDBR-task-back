<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use DB;
use App\Models\User;

class apiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_countries()
    {
        $user = User::where("email", "revaz.gh@gmail.com")->first();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            "Authorization" => "Bearer $token"
        ])->getJson('/api/countries');

        $user->tokens()->delete();

        $response->assertStatus(200);
    }

    public function test_summary()
    {
        $user = User::where("email", "revaz.gh@gmail.com")->first();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            "Authorization" => "Bearer $token"
        ])->getJson('/api/summary');

        $user->tokens()->delete();

        $response->assertStatus(200);
    }
}
