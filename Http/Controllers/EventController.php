<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('start_date', 'asc')->get();
        return view('events.create', compact('events'));
    }

    public function create()
    {
        return redirect()->route('events.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'priority' => 'required',
            'status' => 'required'
        ]);

        Event::create($validatedData + ['user_id' => auth()->id()]);
        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $categories = Category::where('user_id', auth()->id())->get();
        return view('events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'nullable',
            'priority' => 'required|in:low,medium,high',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $event->update($validated);
        return redirect()->route('events.index')->with('success', 'Event updated successfully');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully');
    }
}