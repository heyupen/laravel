<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
 public function up()
 {
  Schema::create('services', function (Blueprint $table) {
   $table->increments('id');
   $table->string('name');
   $table->decimal('price', 7, 2);
   $table->string('url')->nullable();
   $table->string('pdf')->nullable();
   $table->integer('category')->nullable();
   $table->integer('mandatory')->nullable();
   $table->integer('service_category_id')->unsigned();
   $table->foreign('service_category_id')->references('id')->on('service_categories');
   $table->timestamps();
  });
 }
 public function down()
 {
  Schema::dropIfExists('services');
 }
}
