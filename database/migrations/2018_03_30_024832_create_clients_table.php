<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
 public function up()
 {
  Schema::create('clients', function (Blueprint $table) {
    $table->increments('id');
    $table->string('nome');
    $table->string('username')->nullable();
    $table->string('password')->nullable();
    $table->string('email')->nullable();
    $table->string('banca')->nullable();
    $table->string('nomeintestatario')->nullable();
    $table->string('cognomeintestatario')->nullable();
    $table->string('contocarta')->nullable();
    $table->string('mesescadenza')->nullable();
    $table->string('annoscadenza')->nullable();
    $table->string('abi')->nullable();
    $table->string('cab')->nullable();
    $table->string('cin')->nullable();
    $table->string('rid')->nullable();
    $table->string('iban')->nullable();
    $table->string('tipologiapagamento')->nullable();
    $table->string('idtipologiacliente')->nullable();
    $table->string('telefono')->nullable();
    $table->string('fax')->nullable();
    $table->string('pivacf')->nullable();
    $table->string('indirizzo')->nullable();
    $table->string('localita')->nullable();
    $table->string('comune')->nullable();
    $table->string('provincia')->nullable();
    $table->string('stato')->nullable();
    $table->string('cap')->nullable();
    $table->timestamps();
  });
 }
 public function down()
 {
  Schema::dropIfExists('clients');
 }
}
