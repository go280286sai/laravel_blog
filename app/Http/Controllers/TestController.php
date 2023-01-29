<?php

namespace App\Http\Controllers;

use App\Helpers\Dto\getObj;
use App\Models\User;

class TestController extends Controller
{
    public function index()
    {
        $class = new getObj(['name'=>'alex']);
       echo $class->name;
    }
}
