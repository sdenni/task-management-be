<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_register()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'SDenni',
            'email' => 'sdenni@mail.com',
            'password' => 'mypassword',
        ]);

        $response->assertStatus(201);
        $response->assertJson(['message' => 'User registered successfully']);
    }

    /** @test */
    public function user_can_login_and_receive_token()
    {
        $user = User::create([
            'name' => 'SDenni',
            'email' => 'sdenni@mail.com',
            'password' => Hash::make('mypassword'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'sdenni@mail.com',
            'password' => 'mypassword',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['token', 'user']);
    }
}
