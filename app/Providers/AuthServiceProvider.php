<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //注册定义相应的policies
        'App\Model' => 'App\Policies\ModelPolicy',
        \App\Models\channel::class => \App\Policies\ChannelPolicy::class,
        // 'App\Models\channel' => 'App\Policies\ChannelPolicy',
        // '\App\Models\Video' => '\App\Policies\VideoPolicy',
        \App\Models\Video::class => \App\Policies\VideoPolicy::class

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
