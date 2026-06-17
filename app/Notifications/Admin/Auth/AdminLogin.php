<?php

namespace App\Notifications\Admin\Auth;

use App\Models\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminLogin extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public User $admin)
    {
        //
    }

    public function databaseType(object $notifiable): string
    {
        return 'admin-login';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => "{$this->admin->full_name} به سیستم خوش امدید.",
            'data' => [
                'admin_name' => $this->admin->full_name
            ]
        ];
    }
}
