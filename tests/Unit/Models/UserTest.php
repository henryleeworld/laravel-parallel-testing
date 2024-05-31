<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testPasswordWillBeHashed(): void
    {
        $user = User::factory()->create([
            'password' => $password = 'password',
        ]);
        $this->assertTrue(Hash::check($password, $user->password));
    }

    public function testCheckUserEmailVefified(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        $this->assertTrue($user->hasVerifiedEmail());
    }

    public function testCheckUserEmailNotVefified(): void
    {
        $user = User::factory()->unverified()->create();
        $this->assertFalse($user->hasVerifiedEmail());
    }
}
