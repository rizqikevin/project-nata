<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function index()
    {
        $events = Event::where('start_date', '>=', Carbon::now()->format('Y-m-d H:i:s'))
                      ->orderBy('start_date', 'asc')
                      ->orderBy('priority', 'desc')
                      ->take(5)
                      ->get();

        return view('welcome', compact('events'));
    }
}