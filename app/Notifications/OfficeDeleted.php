<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class OfficeDeleted extends Notification
{
    use Queueable;
    public $office;
    public $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($office)
    {
        //
        $this->office =$office;
        $this->message = "Kancelarija ". $office->name ." je obrisana!";
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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

            'name'=>$this->office->name,

            'message'=>$this->message
        ];
    }
    public function toBroadcast($notifiable) {
        return new BroadcastMessage([

        'name'=>$this->office->name,

        'message'=>$this->message ]);
        }
}
