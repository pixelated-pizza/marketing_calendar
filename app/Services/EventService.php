<?php

namespace App\Services;

use App\Models\CalendarEvent;

class EventService
{
    public function getAll()
    {
        return CalendarEvent::with(['channel', 'campaignType'])->get();
    }

    public function getById($id)
    {
        return CalendarEvent::with(['channel', 'campaignType'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return CalendarEvent::create($data);
    }

    public function update($id, array $data)
    {
        $event = CalendarEvent::findOrFail($id);
        $event->update($data);
        return $event;
    }

    public function delete($id)
    {
        $event = CalendarEvent::findOrFail($id);
        $event->delete();
    }
}

