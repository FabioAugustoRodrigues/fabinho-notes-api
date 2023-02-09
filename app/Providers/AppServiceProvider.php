<?php

namespace App\Providers;

use App\Models\Note;
use App\Repositories\Note\NoteRepository;
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
