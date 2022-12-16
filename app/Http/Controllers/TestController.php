<?php

namespace App\Http\Controllers;

use Database\Factories\CategoryFactory;

class TestController extends Controller
{
    public function show()
    {
        $fake = CategoryFactory::new()->count(10)->make();
        dump($fake->toArray());
    }
}
