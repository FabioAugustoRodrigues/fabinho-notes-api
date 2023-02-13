<?php

namespace App\Providers;

use App\Models\Note;
use App\Models\User;
use App\Repositories\Note\NoteRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Note\NoteInterface', 'App\Repositories\Note\NoteRepository');
        $this->app->bind('App\Repositories\Note\NoteInterface', function(){
            return new NoteRepository(new Note());
        });

        $this->app->bind('App\Repositories\User\UserInterface', 'App\Repositories\User\UserRepository');
        $this->app->bind('App\Repositories\User\UserInterface', function(){
            return new UserRepository(new User());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
