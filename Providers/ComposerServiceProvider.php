<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\EventComposer;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', EventComposer::class);
    }
}