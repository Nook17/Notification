<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Notifi_follow extends Notification implements ShouldQueue
{
 use Queueable;

 private $content;

 public function __construct($content)
 {
  $this->content = $content;
 }

 public function via($notifiable)
 {
  return setup_via_notification($this->content['notifi_follow']);
 }

 public function toMail($notifiable)
 {
  return (new MailMessage)->view('mail.mail_notifi_follow', ['user' => $this->content]);
 }

 public function toArray($notifiable)
 {
  return [
   'message' => '<b>' . $this->content['name'] . '</b> began to watch You.',
  ];
 }
}
