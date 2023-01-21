<?php

namespace App\Http\Controllers;

use App\Models\User;
use Database\Factories\CategoryFactory;
use Nette\Utils\Reflection;


class TestController extends Controller
{
    public function index()
    {
        $class = new User();
        }
}
