<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
 use Notifiable;

 protected $fillable = [
  'name', 'email', 'password',
 ];

 protected $hidden = [
  'password', 'remember_token',
 ];

 public function followsOfOther()
 {
  return $this->belongsToMany('App\User', 'follows', 'user_id', 'follow_id');
 }

 public function followsOfMine()
 {
  return $this->belongsToMany('App\User', 'follows');
 }

 public function follow()
 {
  return $this->followsOfOther->merge($this->followsOfMine);
 }

 // *******************************************************
 public function followsOfOtherMerge()
 {
  return $this->belongsToMany('App\User', 'follows', 'follow_id', 'user_id');
 }

 public function followsOfMineMerge()
 {
  return $this->belongsToMany('App\User', 'follows');
 }

 public function followMerge()
 {
  return $this->followsOfOtherMerge->merge($this->followsOfMineMerge);
 }
 // *******************************************************

 public function follow_user()
 {
  return $this->hasMany('App\Follow', 'follow_id');
 }

 public function news()
 {
  return $this->hasMany('App\News');
 }

 public function settings()
 {
  return $this->hasOne('App\Settings');
 }
}
