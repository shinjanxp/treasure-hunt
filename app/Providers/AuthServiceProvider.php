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
        'App\Question' => 'App\Policies\QuestionPolicy',
        'App\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('play', function ($user) {
            if($user->is_admin())
                return true;
            $start = \Carbon\Carbon::parse(env('GAME_START_TIME'));
            $end = \Carbon\Carbon::parse(env('GAME_END_TIME'));
            $now = \Carbon\Carbon::now();
            $last_level = \App\Question::all()->last()->id;
            if( ($now->gt($start) && $now->lt($end)) || $user->level>$last_level )
                return true;
            else
                return false;
        });
        //
    }
}
