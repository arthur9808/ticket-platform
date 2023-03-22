<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;




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
        $event = Event::find($id);
        // dd($event);
        return view('pages.event.show', compact('event'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    
}
