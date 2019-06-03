<?php

namespace App\Notifications;

use App\Mail\NotificationService as Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotificationService extends Notification
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
      $data['url'] = url(config('app.url')."/service/".$data['data']->id."/detail");

      if($data['target'] == "3"){ //target to admin
        $subject = "Maintenance Tool ".optional($data['data']->tools)->code;
      }else{
        $subject = "Approved Maintenance Tool ".optional($data['data']->tools)->code;
      }
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
