<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_login_user()
    {
        $response = $this->post('/login', ['email' => 'test@admin.ua', 'password' => '12345678',  '_token' => csrf_token()]);
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/admin/dashboard');

        $response = $this->get('/admin/posts');
        $this->assertEquals(200, $response->getStatusCode());

        $response = $this->get('/admin/profile');
        $this->assertEquals(200, $response->getStatusCode());

        $response = $this->get('/admin/comments');
        $this->assertEquals(200, $response->getStatusCode());

        $response = $this->get('/admin/tags');
        $this->assertEquals(404, $response->getStatusCode());

        $response = $this->get('/admin/users');
        $this->assertEquals(404, $response->getStatusCode());

        $response = $this->get('/admin/subscribers');
        $this->assertEquals(404, $response->getStatusCode());

        $response = $this->get('/admin/posts_trash');
        $this->assertEquals(404, $response->getStatusCode());

        $response = $this->get('/admin/users_trash');
        $this->assertEquals(404, $response->getStatusCode());

        $response = $this->get('/admin/subscribers');
        $this->assertEquals(404, $response->getStatusCode());

        $response = $this->get('/logout');
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/');
    }
}
