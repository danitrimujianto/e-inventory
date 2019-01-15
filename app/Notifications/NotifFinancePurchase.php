<?php

namespace App\Notifications;

use App\Mail\NotifFinancePurchase as Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifFinancePurchase extends Notification
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
      $data['url'] = '';
      $subject = $data['data']->pr_no." Request New Tool";
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
