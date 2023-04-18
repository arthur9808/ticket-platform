<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Event;

class SmsController extends Controller
{
    public function index() 
    {
        
        return view('pages.sms.index');
    }
    public function create() 
    {
        return view('pages.sms.create');
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
    public function sendCampaign() 
    {
        dd('api');
    }
}
