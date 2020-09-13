<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferServiceTable extends Migration
{
    public function up()
    {
        Schema::create('offer_service', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('offer_id')->unsigned();
         $table->integer('service_id')->unsigned();
         $table->foreign('offer_id')->references('id')->on('offers');
         $table->foreign('service_id')->references('id')->on('services');
         $table->timestamps();
        });
    }
    public function down()
    {
      Schema::dropIfExists('offer_service');
    }
}
