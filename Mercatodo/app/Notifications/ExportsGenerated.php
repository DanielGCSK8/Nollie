<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExportsGenerated extends Notification
{
    use Queueable;

    protected $excelName;

    /**
     * Create a new notification instance.
     *
     * @param string $fileName
     */
    public function __construct($excelName)
    {
        $this->excelName = $excelName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                    ->attach(storage_path('app/public/exports/') . $this->excelName)
                    ->subject(trans('Products'))
                    ->line(trans('Los productos han sido exportados satisfactoriamente, revise la sección de reportes generados'));
                    
                    
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}