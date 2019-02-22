<?php

namespace App\Notifications;

use App\Mail\NotificationHandoverRetur as Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotificationHandoverRetur extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
     public $token;
     public $data;
     public $email;
    public function __construct($data, $email)
    {
      $this->data = $data;
      $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
      $data = $this->data;
      $data['url'] = url(config('app.url')."/horetur/".$data['data']->id."/detail");
      $subject = $data['data']->kode." Handover Retur Tools";
      // dd($data['data']); 
      // $mail = new Mailable($notifiable, $data)->subject($subject)->to($notifiable->email);
      return (new Mailable($notifiable, $data))->subject($subject)->to($this->email);
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
            //
        ];
    }
}
