<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Event;
use App\Models\User;

class CollaborationRequest extends Notification
{
    use Queueable;

    protected $event;
    protected $fromUser;

    public function __construct(Event $event, User $fromUser)
    {
        $this->event = $event;
        $this->fromUser = $fromUser;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You have a new collaboration request for your event.')
                    ->action('View Event', url('/events/' . $this->event->id))
                    ->line('User: ' . $this->fromUser->name);
    }

    public function toArray($notifiable)
    {
        return [
            'event_id' => $this->event->id,
            'event_title' => $this->event->title,
            'from_user_id' => $this->fromUser->id,
            'from_user_name' => $this->fromUser->name,
        ];
    }
}
