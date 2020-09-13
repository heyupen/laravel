<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
 protected $guarded = ['id'];
 public function services()
 {
  return $this->hasMany('App\Service');
 } 
}
