<?php

namespace App\Http\Controllers;

use App\Follow;
use App\Notifications\Notifi_follow;
use App\Notifications\Notifi_unfollow;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
 public function __construct()
 {
  $this->middleware('auth');
 }

 public function search(Request $user)
 {
  if ($user->name) {
   $userName = $user->name;
   $users    = DB::table('users')->where('name', 'like', '%' . $userName . '%')->get();
   return view('/search', compact('users', 'userName'));
  } else {
   return back();
  }
 }

 public function add_follow(Request $request, $userName)
 {
  $follow            = new Follow;
  $follow->user_id   = Auth::user()->id;
  $follow->follow_id = $request->user_follow;
  $follow->save();
  $users = DB::table('users')->where('name', 'like', '%' . $userName . '%')->get();

  $user_follow = User::find($request->user_follow);
  $content     = content_follow($request->user_follow);
  if (!empty($content['notifi_follow'])) {
   $user_follow->notify(new Notifi_follow($content));
  }

  return view('/search', compact('users', 'userName'));
 }

 public function del_follow($user_id, $userName)
 {
  Follow::where('user_id', '=', Auth::user()->id)->Where('follow_id', '=', $user_id)->delete();
  $users = DB::table('users')->where('name', 'like', '%' . $userName . '%')->get();

  $user_follow = User::find($user_id);
  $content     = content_follow($user_id);
  if (!empty($content['notifi_follow'])) {
   $user_follow->notify(new Notifi_unfollow($content));
  }

  return view('/search', compact('users', 'userName'));
 }

 public function settings_index()
 {
  $user     = auth()->user();
  $settings = $user->settings;
  return view('/settings', compact('user', 'settings'));
 }

 public function settings_add(Request $request)
 {
/**
 * notifi = 3 -> email(on) && www(on)
 * notifi = 2 -> email(on) && www(NULL)
 * notifi = 1 -> email(NULL) && www(on)
 * notifi = 0 -> email(NULL) && www(NULL)
 */

  if ($request->follows_email && $request->follows_www) {
   $this->notifi_follow = 3;
  } elseif ($request->follows_email && !$request->follows_www) {
   $this->notifi_follow = 2;
  } elseif (!$request->follows_email && $request->follows_www) {
   $this->notifi_follow = 1;
  } else {
   $this->notifi_follow = null;
  }

  if ($request->news_email && $request->news_www) {
   $this->notifi_news = 3;
  } elseif ($request->news_email && !$request->news_www) {
   $this->notifi_news = 2;
  } elseif (!$request->news_email && $request->news_www) {
   $this->notifi_news = 1;
  } else {
   $this->notifi_news = null;
  }

  $user     = auth()->user();
  $settings = $user->settings;

  $user->name  = $request->name;
  $user->email = $request->email;
  if ($request->password) {
   $user->password = bcrypt($request->password);
  }
  $user->save();

  $settings->notifi_follow = $this->notifi_follow;
  $settings->notifi_news   = $this->notifi_news;
  $settings->save();
  return view('/settings', compact('user', 'settings'));
 }

 public function markAsRead()
 {
  auth()->user()->unreadNotifications->markAsRead();
  return back();
 }
}
