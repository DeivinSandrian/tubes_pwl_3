<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuratDiajukanNotification extends Notification
{   
    
    use Queueable;
    protected $surat;

    /**
     * Create a new notification instance.
     */
    public function __construct($surat)
    {
        $this->surat = $surat;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Surat baru telah diajukan oleh ' . $this->surat->user->nama,
            'surat_id' => $this->surat->id_surat,
            'jenis_surat' => $this->surat->jenis_surat,
            'user_id' => $this->surat->user->id_user,
            'user_name' => $this->surat->user->nama,
            
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Surat baru telah diajukan oleh ' . $this->surat->user->nama,
            'surat_id' => $this->surat->id_surat,
            'jenis_surat' => $this->surat->jenis_surat,
            'user_id' => $this->surat->user->id_user,
            'user_name' => $this->surat->user->nama,
        ];
    }
}
