<?php

namespace App\Http\ViewComposers;

use App\Models\Event;
use Illuminate\View\View;

class EventComposer
{
    public function compose(View $view)
    {
        $view->with('events', Event::orderBy('start_date', 'asc')->get());
    }
}