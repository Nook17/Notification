<?php

namespace App\Http\Controllers;

use App\Follow;
use App\News;
use App\Notifications\Notifi_news;
use App\Notifications\Notifi_unfollow;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
 public function __construct()
 {
  $this->middleware('auth');
 }

 public function index()
 {
  $users = Auth::user()->follow();
  $news  = show_news();
  return view('home', compact('news', 'users'));
 }

 public function home_del_follow($user_id)
 {
  Follow::where('user_id', '=', Auth::user()->id)->Where('follow_id', '=', $user_id)->delete();
  $users = Auth::user()->follow();
  $news  = show_news();

  $user_follow = User::find($user_id);
  $content     = content_follow($user_id);
  if (!empty($content['notifi_follow'])) {
   $user_follow->notify(new Notifi_unfollow($content));
  }
  return view('home', compact('news', 'users'));
 }

 public function add_message(Request $request)
 {
  $message          = new News;
  $message->user_id = Auth::user()->id;
  $message->message = $request->message;
  $message->save();

  $users = Auth::user()->follow();
  $news  = show_news();

  $user_follow = auth()->user()->followMerge();
  foreach ($user_follow as $follow) {
   $content = content_follow($follow->id, $request->message);
   if (!empty($content['notifi_news'])) {
    $follow->notify(new Notifi_news($content));
   }
  }
  return view('home', compact('news', 'users'));
 }
}
