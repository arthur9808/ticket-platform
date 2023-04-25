<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
Use \Carbon\Carbon;



class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('pages.event.index', compact('events'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.event.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        
        $all = $request->except(['_token', 'image']);
        $all['created_by'] = Auth::id();
    //    dd($all);
        $event = Event::create($all);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('uploads','public');
            Event::find($event->id)->update([
                'image' => $image         
            ]);
        }
        $id = $event->id; 

        return redirect()->route('ticket.create', [$id]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $data['event'] = Event::find($id);
        $data['ticket'] = Ticket::where('event_id', $id)->where('available', '1')->first();
        // dd($ticket);
        if ($data['ticket'] != null) {
            $data['count_orders'] = Order::where('ticket_id', $data['ticket']->id)->count();
        }else {
            $data['count_orders'] = 0;

        }
        
        $data['today'] = Carbon::now()->toDateTimeString();
        
        return view('pages.event.show', $data);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::find($id);
        // dd($event->tickets);
        return view('pages.event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $all = $request->except(['_token', 'image']);
        $event = Event::find($id);
        $event->update($all);
        if ($request->hasFile('image')) {
            Storage::delete('public/'.$event->image);
            $image = $request->file('image')->store('uploads','public');
            Event::find($event->id)->update([
                'image' => $image         
            ]);
        }
        return back()->with('succes', 'Event succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::find($id);
        $event->delete();
        return back()->with('succes', 'Event succesfully deleted');
    }

    
}
