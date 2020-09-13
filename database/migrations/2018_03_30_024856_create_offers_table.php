<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
 public function up()
 {
  Schema::create('offers', function (Blueprint $table) {
   $table->increments('id');
   $table->string('pdf');
   $table->integer('user_id')->unsigned()->nullable();
   $table->foreign('user_id')->references('id')->on('users');
   $table->integer('client_id')->unsigned()->nullable();
   $table->foreign('client_id')->references('id')->on('clients');
   $table->timestamps();
  });
 }
 public function down()
 {
  Schema::dropIfExists('offers');
 }
}
