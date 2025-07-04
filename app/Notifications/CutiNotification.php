<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Cuti; // Import model Cuti

class CutiNotification extends Notification
{
    use Queueable;

    protected $cuti;
    protected $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(Cuti $cuti, string $message)
    {
        $this->cuti = $cuti;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        // Kita akan mengirim notifikasi ke database
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'cuti_id' => $this->cuti->id,
            'title' => $this->message,
            'user' => $this->cuti->nama,
        ];
    }
}