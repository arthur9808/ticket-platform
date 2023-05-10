<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Event;
use App\Models\User;


class ApiController extends Controller
{
    public function getOrganizers()
    {   
        $organizers = User::with('events')->get();
        
        return $organizers; 
    }
    public function getEvents()
    {   
        $events = Event::withCount('orders')->get();
        
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
        $order = Order::where('code', $code)->first();
        if ($order->assist == null) {
            $order->update([
                'assist' => true
            ]);
            $response = [
                'message' => 'Thanks for coming'
            ];
            return $response; 
        } else {
            $response = [
                'message' => 'Your assistance has already been registered'
            ];
            return $response; 
        }
    }
}
