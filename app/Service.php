<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
 protected $guarded = ['id'];
 public function service_category()
 {
  return $this->belongsTo('App\ServiceCategory');
 } 
 public function offers()
 {
  return $this->belongsToMany('App\Offers');
 }
}
