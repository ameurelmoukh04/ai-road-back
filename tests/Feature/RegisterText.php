<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterText extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function register_user(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => 'test User',
            'email' => 'testemail@gmail.com',
            'password' => 'testpass'
        ]);
        $response->assertStatus(201)
                ->assertJsonStructure(['NewUser' ,'token']);
    }
}
