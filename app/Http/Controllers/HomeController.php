<?php

namespace App\Http\Controllers;

use App\Follow;
use App\News;
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
  return view('home', compact('news', 'users'));
 }
}
