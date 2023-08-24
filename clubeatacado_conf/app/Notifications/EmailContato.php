<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class EmailContato extends Notification
{
    use Queueable;
    protected $dados;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via()
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail()
    {
            return (new MailMessage)            
            ->subject('Tendering - Mensagem de contato: ' . $this->dados->DS_NOME)
            ->greeting('Mensagem de contato: ' . $this->dados->DS_NOME)
            ->line('Nome: ' . $this->dados->DS_NOME)
            ->line('E-mail: ' . $this->dados->DS_EMAIL)
            ->line('Mensagem: ' . $this->dados->DS_MENSAGEM);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray()
    {
        return [
            //
        ];
    }
}
