<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
 protected $guarded = ['id'];
 public function offers()
 {
  return $this->hasMany('App\Offer');
 } 
}
