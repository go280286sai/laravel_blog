<?php

namespace Tests\Feature;

use Database\Factories\UserFactory;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_user()
    {
        $user = UserFactory::new()->make();
        $user->gender_id = 0;
        $user->name = 'Test';
        $user->birthday = '2001-01-01';
        $user->phone = 12345678;
        $user->myself = 'This is test';
        $this->assertEquals(0, $user->gender);
        $this->assertEquals('Test', $user->name);
        $this->assertEquals('2001-01-01', $user->birthday);
        $this->assertEquals('12345678', $user->phone);
        $this->assertEquals('This is test', $user->myself);
        $password = $user->password;
        $user->generatePassword('0000');
        $this->assertNotEquals($password, $user->password);
        $user->toggleBan($user->status);
        $this->assertEquals('0', $user->status);
        $user->toggleBan($user->status);
        $this->assertEquals('1', $user->status);
    }
}
