<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Notifi_news extends Notification implements ShouldQueue
{
 use Queueable;

 private $content;

 public function __construct($content)
 {
  $this->content = $content;
 }

 public function via($notifiable)
 {
  return setup_via_notification($this->content['notifi_news']);
 }

 public function toMail($notifiable)
 {
  return (new MailMessage)->view('mail.mail_notifi_news', ['user' => $this->content]);
 }

 public function toArray($notifiable)
 {
  return [
   'message' => '<b>' . $this->content['name'] . '</b> wrote a new message.',
  ];
 }
}
