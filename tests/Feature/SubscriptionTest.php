<?php

namespace Tests\Feature;

use App\Models\Subscription;
use Database\Factories\SubscriptionFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use App\Http\Controllers\HomeController;
class SubscriptionTest extends TestCase
{
    protected $table ='subscriptions';
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_subscription()
    {
        $response = $this->call('POST', '/subscribe', array(
            '_token' => csrf_token(), 'email'=>'admin@admin.ua'
        ));
        $this->assertEquals(302, $response->getStatusCode());
    }
}
