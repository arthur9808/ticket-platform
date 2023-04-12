<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Stripe;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //Orders by Ticket
    public function index($id)
    {
        $ticket = Ticket::find($id);
        $orders = Order::where('ticket_id', $id)->get();
        
        return view('pages.orders.index', compact('ticket', 'orders'));
        
    }

    public function orderByEvent($id)
    {
        $event = Event::find($id);
        return view('pages.orders.orders-by-event', compact('event'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $all = $request->except(['_token']);
        $ticket = Ticket::where('id', $all['ticket_id'])->first();
        // dd($ticket->event->user->email);
        for ($i=0; $i < $request->quantity; $i++) { 
                $all['code'] = Str::random(5);
                $order = Order::create($all);
                QrCode::format('png')->size(100)->generate($all['code'], '../public/storage/uploads/'. $all['code'] .'.png');
                $order->update([
                    'svg_qr' => 'uploads/' . $all['code'] . '.png'
                ]);
                
                $data = array(
					'name' => $all['name_buyer'],
					'email' => $all['email_buyer'],
					'subject' => $ticket->event->title,
                    'user_name' => $ticket->event->user->username,
                    'user_email' => $ticket->event->user->email
				);
                Mail::send('pages.email.email', $data, function ($message) use ($data) {
					$message->from('admin@marketingnature.com', $data['user_name']);
					$message->to($data['email'], $data['name']);
					$message->subject($data['subject']);
					$message->priority(3);
				});
        }
        return back()->with('succes', 'Successful purchase, you will receive an email with your tickets');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
