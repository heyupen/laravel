<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
 public function client()
 {
  return $this->belongsTo('App\Client');
 } 
 public function services()
 {
  return $this->belongsToMany('App\Service'); 
 }
 public function user()
 {
  return $this->belongsTo('App\User'); 
 }
 public function getServiceIdsAttribute()
 {
  return $this->services->pluck('service_category_id');
 }
}
