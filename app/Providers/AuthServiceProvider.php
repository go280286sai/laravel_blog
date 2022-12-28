<?php

namespace App\Providers;

use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('subscription', function () {
            Log::info('Gate subscription: '.Auth::user()->name);

            return Auth::user()->is_admin == true;
        });
        Gate::define('category', function () {
            Log::info('Gate category: '.Auth::user()->name);

            return Auth::user()->is_admin == true;
        });
        Gate::define('tag', function () {
            Log::info('Gate tag: '.Auth::user()->name);

            return Auth::user()->is_admin == true;
        });
        Gate::define('user', function () {
            Log::info('Gate user: '.Auth::user()->name);

            return Auth::user()->is_admin == true;
        });
        Gate::define('comment', function () {
            Log::info('Gate comment: '.Auth::user()->name);

            return Auth::check() == true;
        });

        //
    }
}
