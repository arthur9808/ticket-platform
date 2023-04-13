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
    public function test() 
    {
        $code = 'HtVUp';
        $order = Order::where('code', $code)->first();
        $event = Event::where('id', $order->ticket->event_id)->first(); 
        
        $data = [
            'event_image'    => $event->image,
            'name_ticket'    => $order->ticket->title,
            'qr'             => $order->svg_qr,
            'website'        => $event->user->web_url
        ];
        return view('pages.orders.order-ticket-qr', $data);
    }
    public function pdf($code) 
    {   
        
        $order = Order::where('code', $code)->first();
        $event = Event::where('id', $order->ticket->event_id)->first(); 
        
        $options = ['isPhpEnabled' => true, 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true, 'enableFontSubsetting' => true, 'isJavascriptEnabled' => true, 'isPhpEnabled' => true, 'debugKeepTemp' => true, 'isHtml5ParserEnabled' => true, 'chroot' => public_path(), 'defaultMediaType' => 'print', 'enableCssFloat' => true, 'isFontSubsettingEnabled' => true, 'isHtml5ParserEnabled' => true, 'isPhpEnabled' => true, 'isRemoteEnabled' => true, 'enableHtml5Parser' => true, 'enableRemote' => true, 'fontHeightRatio' => 1.3, 'isHtml5ParserEnabled' => true, 'isPhpEnabled' => true, 'logOutputFile' => storage_path('logs/dompdf.log'), 'pdfBackend' => 'CPDF', 'tempDir' => storage_path('app/temp')];

        $pdf = PDF::loadView('pages.orders.order-ticket-qr', [
            'event_image'    => $event->image,
            'name_ticket'    => $order->ticket->title,
            'qr'             => $order->svg_qr,
            'website'        => $event->user->web_url
        ], [], $options);

        $pdf->setPaper('A4', 'portrait'); // Establecer el tamaño del papel y la orientación
        $pdf->output(); // Generar el archivo PDF

        // Agregar esta línea para centrar el contenido del PDF
        $pdf->getDomPDF()->set_option('defaultMediaType', 'print');
        $pdf->getDomPDF()->set_option('isPhpEnabled', true);
        $pdf->getDomPDF()->set_option('enable_html5_parser', true);
        $pdf->getDomPDF()->set_option('chroot', public_path());
        $pdf->getDomPDF()->set_option('enable_css_float', true);
        $pdf->getDomPDF()->set_option('font_height_ratio', 1.3);
        $pdf->getDomPDF()->set_option('pdf_backend', 'CPDF');
        $pdf->getDomPDF()->set_option('tempDir', storage_path('app/temp'));
        $pdf->getDomPDF()->set_base_path(public_path());
        $pdf->getDomPDF()->set_base_path($event->user->web_url);

        return $pdf->download('sample.pdf');
    }
}
