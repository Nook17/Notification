<?php

use App\Follow;
use App\News;
use App\User;
use Illuminate\Support\Facades\Auth;

function is_follow($follow_id)
{
 return Follow::where([
  'user_id'   => Auth::id(),
  'follow_id' => $follow_id,
 ])->exists();
}

function show_news()
{
 $users       = Auth::user()->follow();
 $follow_id[] = Auth::user()->id;
 foreach ($users as $user) {
  $follow_id[] = $user->id;
 }
 $news = News::whereIn('user_id', $follow_id)->orderBy('created_at', 'DESC')->get();
 return $news;
}

function content_follow($user_id, $user_message = 'empty')
{
 $user_follow   = User::find($user_id);
 $notifi_auth   = Auth::user();
 $settings      = $user_follow->settings;
 $notifi_follow = $settings->notifi_follow;
 $notifi_news   = $settings->notifi_news;
 $content       = [
  'name'          => $notifi_auth->name,
  'message'       => $user_message,
  'notifi_follow' => $notifi_follow,
  'notifi_news'   => $notifi_news,
 ];
 return $content;
}

function setup_via_notification($notifi)
{
 if ($notifi == 3) {
  return ['mail', 'database'];
 } elseif ($notifi == 2) {
  return ['mail'];
 } elseif ($notifi == 1) {
  return ['database'];
 }
}
