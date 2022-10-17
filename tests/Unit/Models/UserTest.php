<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testPasswordWillBeHashed()
    {
        Hash::shouldReceive("make")
            ->once()
            ->andReturn("hashed");

        $user = new User([
            "name" => "User",
            "password" => Hash::make("rawpassword"),
        ]);
        $this->assertEquals("hashed", $user->password);
    }

    public function testCheckUserEmailVefified()
    {
        $user = new User();
        $user->email_verified_at = now();
        $this->assertTrue($user->hasVerifiedEmail());
    }

    public function testCheckUserEmailNotVefified()
    {
        $user = new User();
        $this->assertFalse($user->hasVerifiedEmail());
    }
}
