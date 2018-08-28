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
//   return $this->hasMany('App\Follow');
  return $this->followsOfOther->merge($this->followsOfMine);
 }

 public function news()
 {
  return $this->hasMany('App\News');
 }
}
