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
use PDF;

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
        // dd($ticket);
        $codes = [];
        $orders_data = [];

        for ($i=0; $i < $request->quantity; $i++) { 
                $all['code'] = Str::random(5);
                $order = Order::create($all);
                QrCode::format('png')->size(200)->style('round')->backgroundColor(255, 255, 255)->generate($all['code'], '../public/storage/uploads/'. $all['code'] .'.png');
                $order->update([
                    'svg_qr' => 'uploads/' . $all['code'] . '.png'
                ]);
                $codes[] = $order->code;
                $event = Event::where('id', $order->ticket->event_id)->first(); 
                $orders_data[] = [
                    'event_title'     => $event->title,
                    'event_ubication' => $event->ubication,
                    'event_datetime'  => $event->date_time_start,
                    'order'           => $order->id,
                    'type_ticket'     => $order->ticket->type,
                    'name_ticket'     => $order->ticket->title,
                    'name_buyer'      => $order->name_buyer . ' ' . $order->last_name_buyer,
                    'order_date'      => $order->created_at,
                    'qr'              => $order->svg_qr,
                    'website'         => $event->user->web_url
                ];

            }
            $pdf = PDF::loadView('pages.orders.pdf', ['orders_data' => $orders_data]);
            
            $data = array(
                'name' => $all['name_buyer'],
                'email' => $all['email_buyer'],
                'subject' => $ticket->event->title,
                'user_name' => $ticket->event->user->username,
                'user_email' => $ticket->event->user->email,
                'event_image' => $ticket->event->image,
                'organizer_image' => $ticket->event->user->image,
                'event_location' => $ticket->event->maps_url,
                'code' => $order->code
            );
            Mail::send('pages.email.email', $data, function ($message) use ($data, $pdf) {
                $message->from('admin@ticketsplatform.com', $data['user_name']);
                $message->to($data['email'], $data['name']);
                $message->subject($data['subject']);
                $message->priority(3);
                $message->attachData($pdf->output(), 'Order.pdf');
            });
        $codes = implode('-', $codes);
        return redirect()->route('successpage', [$codes]);
       
    }

    public function successpage($codes)
    {
        $codes = explode('-', $codes);
        $order = Order::where('code', $codes[0])->first();
        $event = Event::where('id', $order->ticket->event_id)->first(); 
        $location = $event->ubication . ' ' . $event->street_address . ', ' . $event->address_locality . ', ' . $event->address_region . ' ' . $event->postal_code . ', ' . $event->address_country;

        // dd($event);
        return view('pages.orders.successpage', compact('event', 'order', 'codes', 'location'));
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
    public function test() 
    {
        $code = 'HtVUp';
        $order = Order::where('code', $code)->first();
        $event = Event::where('id', $order->ticket->event_id)->first(); 
        $pdf = PDF::loadView('pages.orders.pdf', [
            'event_title'     => $event->title,
            'event_ubication' => $event->ubication,
            'event_datetime'  => $event->date_time_start,
            'order'           => $order->id,
            'type_ticket'     => $order->ticket->type,
            'name_ticket'     => $order->ticket->title,
            'name_buyer'      => $order->name_buyer . ' ' . $order->last_name_buyer,
            'order_date'      => $order->created_at,
            'qr'              => $order->svg_qr,
            'website'         => $event->user->web_url
        ]);
        $data = [
            'event_title'     => $event->title,
            'event_ubication' => $event->ubication,
            'event_datetime'  => $event->date_time_start,
            'order'           => $order->id,
            'type_ticket'     => $order->ticket->type,
            'name_ticket'     => $order->ticket->title,
            'name_buyer'      => $order->name_buyer . ' ' . $order->last_name_buyer,
            'order_date'      => $order->created_at,
            'qr'              => $order->svg_qr,
            'website'         => $event->user->web_url
        ];
        
        return view('pages.orders.pdf', $data);
        return $pdf->download('sample.pdf');

    }
    public function pdf($code) 
    {   
        
        $order = Order::where('code', $code)->first();
        $event = Event::where('id', $order->ticket->event_id)->first(); 
        $pdf = PDF::loadView('pages.orders.pdf', [
            'event_title'     => $event->title,
            'event_ubication' => $event->ubication,
            'event_datetime'  => $event->date_time_start,
            'order'           => $order->id,
            'type_ticket'     => $order->ticket->type,
            'name_ticket'     => $order->ticket->title,
            'name_buyer'      => $order->name_buyer . ' ' . $order->last_name_buyer,
            'order_date'      => $order->created_at,
            'qr'              => $order->svg_qr,
            'website'         => $event->user->web_url
        ]);
        return $pdf->download('sample.pdf');
        
    }
}
