<?php
use App\Follow;
use App\News;
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
