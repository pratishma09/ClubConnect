<?php

namespace App\Listeners;

use App\Events\EventCreated;
use App\Mail\EventNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class NotifySubscribers
{

    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EventCreated $event): void
    {
        Log::info('Event received: ' . $event->event->title);
        $subscribers = Subscription::pluck('email')->toArray();

        foreach ($subscribers as $subscriber) {
            Log::info('Sending email to: ' . $subscriber);
            Mail::to($subscriber)->send(new EventNotification($event->event->title));
        }
    }
}
