<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('reports.index', compact('events'));
    }
}
