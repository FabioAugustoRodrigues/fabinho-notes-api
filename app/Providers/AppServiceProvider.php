<?php

namespace App\Providers;

use App\Models\Note;
use App\Repositories\Note\NoteRepositoryEloquent;
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
        $this->app->bind('App\Repositories\Note\NoteRepositoryInterface', 'App\Repositories\Note\NoteRepositoryEloquent');
        $this->app->bind('App\Repositories\Note\NoteRepositoryInterface', function(){
            return new NoteRepositoryEloquent(new Note());
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
