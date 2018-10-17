<?php

namespace App\Services;


use App\Models\Event;

class EventServices
{
    /**
     * Get all events.
     * @return Event[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getEvents()
    {
        return Event::all();
    }
}