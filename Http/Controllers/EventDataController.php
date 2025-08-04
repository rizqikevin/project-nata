<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $events = Event::where('user_id', auth()->id())
            ->orderBy('start_date', 'asc')
            ->get()
            ->map(function($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'start' => $event->start_date,
                    'end' => $event->end_date,
                    'priority' => $event->priority,
                    'status' => $event->status,
                    'color' => $event->priority == 'high' ? '#dc3545' : 
                              ($event->priority == 'medium' ? '#ffc107' : '#0dcaf0')
                ];
            });
        
        return response()->json($events);
    }
}