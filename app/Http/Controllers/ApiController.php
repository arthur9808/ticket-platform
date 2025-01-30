<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function getOrganizers()
    {   
        $organizers = User::with('events')->get();
        
        return $organizers; 
    }
    public function getEvents(Request $request)
    {   
        $from = $request->query('from');
        $to = $request->query('to');

        $query = Event::withCount('orders')->with('totalTickets');

        if ($from) {
            $query->where('date_time_start', '>=', Carbon::parse($from));
        }

        if ($to) {
            $query->where('date_time_end', '<=', Carbon::parse($to));
        }

        $events = $query->get();

        $events = $events->map(function ($event) {
            $event['earned'] = $event->totalPrice;
            return $event;
        })->makeHidden('orders');
        
        return $events; 
    }
    public function getEvent($id)
    {   
        $event = Event::with('orders')->where('id', $id)->first();
        
        return $event; 
    }
    public function getOrders()
    {   
        $orders = Order::all();
        
        return $orders; 
    }

    public function assistOrder($code)
    {   
        $date = Carbon::now();
        $formattedDate = $date->format('F j, Y');
        $order = Order::where('code', $code)->first();
        if ($order == null) {
            $response = [
                'message' => 'The code ' . $code . ' dont exist'
            ];
        }
        if ($order->assist == null) {
            $order->update([
                'assist' => true
            ]);
            $response = [
                'message' => 'Confirmed attendance for ' . $order->name_buyer . ' at the ' . $order->ticket->event->title . ' event ' . $formattedDate
            ];
            return $response; 
        } else {
            $response = [
                'message' => 'This code has already been registered'
            ];
            return $response; 
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json(['token' => $token], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
