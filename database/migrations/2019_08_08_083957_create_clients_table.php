<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->comment('Название компании');
            $table->string('inn')->nullable()->comment('ИНН');
            $table->timestamps();
        });
        Schema::create('client_contacts', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('client_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
            $table->foreign('client_id')->on('clients')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_contacts');
        Schema::dropIfExists('clients');
    }
}
