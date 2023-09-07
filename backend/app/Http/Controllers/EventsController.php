<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class EventsController extends Controller
{
    public function index()
    {
        $events = DB::table('events')->orderBy('start_date', 'desc')->get();
        
        return Inertia::render('Event/index', [
        "events" => $events
        ]
    );
    }

    public function store(Request $request)
    {
        Event::create($request->all());
        return redirect('/events');
    }

    public function delete(Request $request, $eventId)
    {
        $events = DB::table('events')->where('id', $eventId)->delete();
    }

    public function index2(Request $request, $eventId)
    {
        $events = DB::table('events')->where('id', $eventId)->get();
        return Inertia::render('Event/modify', [
            "events" => $events
            ]
        );
    }

    public function update(Request $request, $eventId)
{
    $event = Event::find($eventId);
    if (!$event) {
        dd($request);
    }

    $event->nom = $request->input('nom');
    $event->description = $request->input('description');
    $event->place = $request->input('place');
    $event->start_date = $request->input('start_date');

    $event->save();

    return redirect('/events');
}
}
