<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOfferTableStatus extends Migration
{
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
         $table->enum('status', array('In creazione', 'Creata', 'Firmata'))->default('Creata');
        });
    }
    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
         $table->dropColumn('status');
        });
    }
}
