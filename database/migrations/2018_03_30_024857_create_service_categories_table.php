<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceCategoriesTable extends Migration
{
 public function up()
 {
  Schema::create('service_categories', function (Blueprint $table) {
   $table->increments('id');
   $table->string('name');
   $table->timestamps();
  });
 }
 public function down()
 {
  Schema::dropIfExists('service_categories');
 }
}
