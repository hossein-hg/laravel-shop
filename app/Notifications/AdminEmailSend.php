<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminEmailSend extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $body;
    private $subject;
    private $files;
    public function __construct($subject,$body,$files = null)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->files = $files;
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
        $details['subject'] = $this->subject;
        $details['body'] = $this->body;

        $mail =  (new MailMessage)
            ->markdown('emails.send-admin-email',compact(['details']));

        foreach ($this->files as $file){
            $mail->attach(public_path($file->file_path));
        }
        return $mail;
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
