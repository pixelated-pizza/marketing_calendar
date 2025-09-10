<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index()
    {
        return response()->json($this->eventService->getAll());
    }

    public function show($id)
    {
        return response()->json($this->eventService->getById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'campaign_type_id' => 'required|integer',
            'channel_id' => 'required|integer',
            'event_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $event = $this->eventService->create($data);

        return response()->json($event, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'campaign_type_id' => 'sometimes|integer',
            'channel_id' => 'sometimes|integer',
            'event_name' => 'sometimes|string|max:255',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
        ]);

        $event = $this->eventService->update($id, $data);

        return response()->json($event);
    }

    public function destroy($id)
    {
        $this->eventService->delete($id);
        return response()->json(null, 204);
    }
}
