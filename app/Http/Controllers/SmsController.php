<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Event;
use App\Models\Order;

class SmsController extends Controller
{
    public function index() 
    {
        
        return view('pages.sms.index');
    }
    public function create() 
    {
        $access_token = env('SHORTYSMS_TOKEN');
        
        $response = Http::withToken($access_token)->withHeaders([
            'Content-Type' => 'application/json'
        ])
        ->get('https://shortysms.com/api/contact-lists');
        $response = $response->collect();
        $response = $response->toArray();
        if (array_key_exists('data', $response)) {
            $contact_lists = $response['data'];
        } else {
            $contact_lists = [];
        }
        // dd($contact_lists);
        return view('pages.sms.createCampaign', compact('contact_lists'));
    }

    public function addCampaingStore(Request $request) {
        dd($request);
        $schedule = gmdate('Y-m-d H:i:s', $request->schedule);
        $access_token = env('SHORTYSMS_TOKEN');
        
        $response = Http::withToken($access_token)->withHeaders([
            'Content-Type' => 'application/json'
        ])
        ->post('https://shortysms.com/api/campaigns', [
            'title' => $request->title,
            'content' => $request->message,
            'contact_list_id' => $request->contact_list,
            'from_phone_number' => '1',
            'scheduled_at' => 'a'
        ]);
        $response = $response->collect();
        $response = $response->toArray();
        if (array_key_exists('data', $response)) {
            $contact_lists = $response['data'];
        } else {
            $contact_lists = [];
        }
        // dd($contact_lists);
        return view('pages.sms.createCampaign', compact('contact_lists'));
    }

    public function indexContactList() 
    {
        $access_token = env('SHORTYSMS_TOKEN');
        
        $response = Http::withToken($access_token)->withHeaders([
            'Content-Type' => 'application/json'
        ])
        ->get('https://shortysms.com/api/contact-lists');
        $response = $response->collect();
        $response = $response->toArray();
        if (array_key_exists('data', $response)) {
            $contact_lists = $response['data'];
        } else {
            $contact_lists = [];
        }

        return view('pages.sms.contactlist', compact('contact_lists'));
    }
    public function createContactList() 
    {
        return view('pages.sms.createContactlist');
    }
    public function storeContactList(Request $request) 
    {
        $access_token = env('SHORTYSMS_TOKEN');
        
        $response = Http::withToken($access_token)->withHeaders([
            'Content-Type' => 'application/json'
        ])
        ->post('https://shortysms.com/api/contact-lists', [
            'name' => $request->title
        ]);
        $response = $response->collect();
        $response = $response->toArray();
        if(array_key_exists('contactList', $response)){
            return redirect('/contact-list')->with('succes', 'Contact List succesfully created.');
        } else {
            return redirect('/contact-list')->with('error', 'Some error has occurred.');
            
        }
    }
    public function addContactsTo($id, $name) 
    {
        $events = Event::all();
        $tickets = Ticket::all();
        return view('pages.sms.add-contacts', compact('id', 'name', 'events', 'tickets'));
    }
    public function addCcontactsToStore(Request $request, $id, $name) 
    {
        // dd($request);
        $access_token = env('SHORTYSMS_TOKEN');

        if ($request->type == 'event') {
            $event = Event::where('id', $request->events)->first();
            $orders = $event->orders->unique('phone_buyer');
            foreach ($orders as $order) {
                $response = Http::withToken($access_token)->withHeaders([
                    'Content-Type' => 'application/json'
                ])
                ->post('https://shortysms.com/api/contacts', [
                    'email' => $order->email_buyer,
                    'first_name' => $order->name_buyer,
                    'last_name' => $order->last_name_buyer,
                    'phone' => $order->phone_buyer,
                    'contact_list_id' => $id
                ]);
            }
        } else {
            $orders = Order::where('ticket_id', $request->tickets)->get();
           
            foreach ($orders as $order) {
                $response = Http::withToken($access_token)->withHeaders([
                    'Content-Type' => 'application/json'
                ])
                ->post('https://shortysms.com/api/contacts', [
                    'email' => $order->email_buyer,
                    'first_name' => $order->name_buyer,
                    'last_name' => $order->last_name_buyer,
                    'phone' => $order->phone_buyer,
                    'contact_list_id' => $id
                ]);
            }
        }
        return redirect('/contact-list')->with('succes', 'Contacts added to ' . $name);
        
    }
    public function sendCampaign() 
    {
        dd('api');
    }
}
