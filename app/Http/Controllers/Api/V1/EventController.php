<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        $events = Event::with(['creator','participants','schedules','originAddress','destinationAddress'])->paginate(10);
        return response()->json(['events' => $events], 201);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'origin_address_id' => 'required|exists:addresses,id',
            'destination_address_id' => 'nullable|exists:addresses,id',
        ]);

        $event = Event::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'origin_address_id' => $validated['origin_address_id'],
            'destination_address_id' => $validated['destination_address_id'],
            'created_by' => auth()->id(),
        ]);

        // Add creator as a participant
        $event->participants()->attach(auth()->id());

        return response()->json(['event' => $event], 201);
    }

    public function join($eventId)
    {
        $event = Event::findOrFail($eventId);

        if (!$event->participants->contains(auth()->id())) {
            $event->participants()->attach(auth()->id());
        }

        return response()->json(['message' => 'Joined the event successfully.']);
    }

    public function leave($eventId)
    {
        $event = Event::findOrFail($eventId);

        $event->participants()->detach(auth()->id());

        return response()->json(['message' => 'Left the event successfully.']);
    }



}
