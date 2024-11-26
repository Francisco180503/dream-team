<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DenunciaUrgenteNotificacion extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
   {
       return (new MailMessage)
                   ->subject('Alerta: Denuncia Urgente Detectada')
                   ->line('Se ha identificado una denuncia urgente:')
                   ->line('Titulo: ' . $this->denuncia->titulo)
                   ->action('Ver Denuncia', url('/denuncias/' . $this->denuncia->id))
                   ->line('Por favor, actúa lo antes posible.');
   }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
