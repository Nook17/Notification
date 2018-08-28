<?php

namespace App\Http\Controllers;

use App\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
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
  return view('/search', compact('users', 'userName'));
 }

 public function del_follow($user_id, $userName)
 {
  Follow::where('user_id', '=', Auth::user()->id)->Where('follow_id', '=', $user_id)->delete();
  $users = DB::table('users')->where('name', 'like', '%' . $userName . '%')->get();
  return view('/search', compact('users', 'userName'));
 }

 public function index()
 {
  //
 }

 public function create()
 {
  //
 }

 public function store(Request $request)
 {
  //
 }

 public function show($id)
 {
  //
 }

 public function edit($id)
 {
  //
 }

 public function update(Request $request, $id)
 {
  //
 }

 public function destroy($id)
 {
  //
 }
}
