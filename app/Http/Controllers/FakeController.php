<?php

namespace App\Http\Controllers;

use Database\Factories\CategoryFactory;
use Database\Factories\PostFactory;
use Database\Factories\SubscriptionFactory;
use Database\Factories\TagFactory;

class FakeController extends Controller
{
    public function setCategories()
    {
        CategoryFactory::new()->count(10)->create();

        return redirect('/admin/dashboard');
    }

    public function setTags()
    {
        TagFactory::new()->count(10)->create();

        return redirect('/admin/dashboard');
    }

    public function setSubscribers()
    {
        SubscriptionFactory::new()->count(10)->create();

        return redirect('/admin/dashboard');
    }

    public function setPosts()
    {
        PostFactory::new()->count(10)->create();

        return redirect('/admin/dashboard');
    }
}
