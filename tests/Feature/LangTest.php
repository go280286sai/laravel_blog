<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class LangTest extends TestCase
{
    public function test_lang_user()
    {
        $this->get('/greeting/uk');
        $this->assertEquals('uk', Cache::get('lang'));
        $this->get('/greeting/ru');
        $this->assertEquals('ru', Cache::get('lang'));
        $this->get('/greeting/en');
        $this->assertEquals('en', Cache::get('lang'));
        $response = $this->get('/greeting/fr');
        $this->assertEquals(400, $response->getStatusCode());
    }
}
