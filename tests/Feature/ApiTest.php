<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_authorize()
    {
        $response = $this->post('/api/register', ['name' => 'Api_User', 'email' => 'api_user@admin.ua', 'password' => 12345678]);
        if ($response->getStatusCode() != 200) {
            $response = $this->post('/api/login', ['email' => 'api_user@admin.ua', 'password' => 12345678]);
        }
       $response->assertOk();
    }

    public function test_category()
    {
        $category = $this->get('/api/category');
        $this->assertEquals(200, $category->status());
        $this->assertNotEmpty($category);
    }

    public function test_tags()
    {
        $tags = $this->get('/api/category');
        $tags->assertOk();
    }

    public function test_profile()
    {

        Sanctum::actingAs(
            User::find(1),
            ['*']
        );
        $profile = $this->json('GET', '/api/profile');
        $profile->assertOk();
    }

    public function test_post()
    {

        Sanctum::actingAs(
            User::find(1),
            ['*']
        );
        $profile = $this->json('GET', '/api/post');
        $profile->assertOk();
    }
}
