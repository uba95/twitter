<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;

class LikeNotifacation extends Notification
{
    use Queueable;
    public $from;
    // public $tweet;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($from)
    {
        $this->from = $from;
        // $this->tweet = $tweet;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Hello '. $notifiable->name . ',')
                    ->line($this->from->name . ' Liked Your Tweet!')
                    ->action('Notifications', url('/notifications'))
                    ->line('Thank you for using our application!');
    }
    
    /**
     * Get the Nexmo / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
                    ->content($this->from->name . ' Liked Your Tweet!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'name' => $this->from->name,            
            'username' => $this->from->username,            
            // 'tweet' => $this->tweet->id,            
        ];
    }
}
