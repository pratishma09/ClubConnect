<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RemoteMerge\Esewa\Client;
use RemoteMerge\Esewa\Config;
use Barryvdh\DomPDF\Facade\Pdf;

require '../vendor/autoload.php';

class PaymentController extends Controller
{
    public function esewaPay(Request $request)
    {
        $pid = uniqid();
        $amount = $request->amount;
        $ticketCount = $request->ticket_count;
        $buyerName = $request->buyer_name;
        $totalAmount = $ticketCount * $amount;
        $eventId = $request->eventId;

        // Create a ticket record
        $ticket = Ticket::create([
            'event_id' => $eventId,
            'buyer_name' => $buyerName,
            'ticket_count' => $ticketCount,
            'created_at' => Carbon::now(),
        ]);

        // Set success and failure callback URLs
        $successUrl = url('/success') . '?ticket_id=' . $ticket->id;
        $failureUrl = url('/failure');

        // Config for eSewa
        $config = new Config($successUrl, $failureUrl);

        // Initialize eSewa client and process payment
        $esewa = new Client($config);
        $esewa->process($pid, $totalAmount, 0, 0, 0);
    }

    public function esewaPaySuccess(Request $request)
{
    // Retrieve the ticket ID from the request query parameters
    $ticketId = $request->query('ticket_id');

    // Find the ticket and event details
    $ticket = Ticket::find($ticketId);
    $idtick=$ticket->id+150823;
    if (!$ticket) {
        return redirect('/failure')->with('error', 'Ticket not found.');
    }

    $event = Event::find($ticket->event_id);
    if (!$event) {
        return redirect('/failure')->with('error', 'Event not found.');
    }

    // Return the ticket view with event details
    return view('users.events.ticket', compact('ticket', 'event','idtick'));
}

    public function esewaPayFailed(Request $request)
{
    // Log the failure details
    

    // Redirect to a custom 404 error page
    abort(404, 'Payment failed. The page you are looking for does not exist.');
}

public function downloadTicket($ticketId)
    {
        // Retrieve the ticket and event details
        $ticket = Ticket::find($ticketId);
        if (!$ticket) {
            return redirect('/failure')->with('error', 'Ticket not found.');
        }

        $event = Event::find($ticket->event_id);
        if (!$event) {
            return redirect('/failure')->with('error', 'Event not found.');
        }

        // Generate PDF
        $pdf = Pdf::loadView('pdf.ticket', compact('ticket', 'event'));
        return $pdf->download('ticket-' . $ticketId . '.pdf');
    }
}
