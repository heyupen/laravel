<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;

class User extends Authenticable
{
 protected $fillable = ['username', 'passowrd', 'token'];
 public function offers()
 {
  return $this->hasMany('App\Offer');
 }
}
