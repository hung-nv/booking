<?php

namespace App\Http\Controllers\Backend;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{
    public function index() {
        $events = Event::orderByDesc('id')->get();
        return view('backend.event.index', [
            'events' => $events
        ]);
    }

    public function show($id) {
        $event = Event::findOrFail($id);
        return view('backend.event.show', [
            'event' => $event
        ]);
    }

    public function edit($id) {
        $event = Event::findOrFail($id);
        return view('backend.event.update', [
            'event' => $event
        ]);
    }

    public function create() {
        return view('backend.event.create');
    }

    public function update(Request $request, $id) {
        Validator::make($request->all(), [
            'name' => 'required|max:255',
        ])->validate();

        $data = $request->all();
        $data['start_at'] = date('Y-m-d H:i:s', strtotime($data['start_at']));
        $data['end_at'] = date('Y-m-d H:i:s', strtotime($data['end_at']));

        $event = Event::findOrFail($id);
        if($event->update($data)) {
            return redirect()->route('event.index')->with(['success' => 'Event has been updated']);
        }
    }

    public function store(Request $request) {
        Validator::make($request->all(), [
            'name' => 'required|max:255',
        ])->validate();

        $data = $request->all();
        $data['start_at'] = date('Y-m-d H:i:s', strtotime($data['start_at']));
        $data['end_at'] = date('Y-m-d H:i:s', strtotime($data['end_at']));

        if(Event::create($data)) {
            return redirect()->route('event.index')->with(['success' => 'Event has been created']);
        }
    }

    public function destroy($id) {
        $event = Event::findOrFail($id);
        if ($event->delete()) {
            Session::flash('success', 'Your event has been delete!');
        } else {
            Session::flash('error', 'Fail to delete event');
        }
        return redirect()->route('event.index');
    }
}
