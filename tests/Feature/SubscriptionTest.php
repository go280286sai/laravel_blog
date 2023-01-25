<?php

namespace Tests\Feature;

use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    protected $table = 'subscriptions';

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_subscription()
    {
        $response = $this->call('POST', '/subscribe', [
            '_token' => csrf_token(), 'email' => 'admin@admin.ua',
        ]);
        $this->assertEquals(302, $response->getStatusCode());
    }
}
