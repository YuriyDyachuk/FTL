<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatetimeBlock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datetime_block', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->string('time')->nullable();
            $table->boolean('interval')->nullable();
            $table->string('time_from')->nullable();
            $table->string('time_to')->nullable();
            $table->timestamps();
        });

        Schema::create('datetimes_providers',  function (Blueprint $table){
            $table->unsignedBigInteger('datetime_block_id');
            $table->unsignedBigInteger('provider_block_id')->unique();
            $table->foreign('datetime_block_id')->references('id')->on('datetime_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('provider_block_id')->references('id')->on('provider_block')
                ->onDelete('cascade')->onUpdate('restrict');
        });

        Schema::create('datetimes_ftls',  function (Blueprint $table){
            $table->unsignedBigInteger('datetime_block_id');
            $table->unsignedBigInteger('ftl_block_id')->unique();
            $table->foreign('datetime_block_id')->references('id')->on('datetime_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('ftl_block_id')->references('id')->on('ftl_block')
                ->onDelete('cascade')->onUpdate('restrict');
        });

        Schema::create('datetimes_terminals',  function (Blueprint $table){
            $table->unsignedBigInteger('datetime_block_id');
            $table->unsignedBigInteger('terminal_block_id')->unique();
            $table->foreign('datetime_block_id')->references('id')->on('datetime_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('terminal_block_id')->references('id')->on('terminal_block')
                ->onDelete('cascade')->onUpdate('restrict');
        });

        Schema::create('datetimes_clients',  function (Blueprint $table){
            $table->unsignedBigInteger('datetime_block_id');
            $table->unsignedBigInteger('client_block_id')->unique();
            $table->foreign('datetime_block_id')->references('id')->on('datetime_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('client_block_id')->references('id')->on('client_block')
                ->onDelete('cascade')->onUpdate('restrict');
        });

        Schema::create('datetimes_trains',  function (Blueprint $table){
            $table->unsignedBigInteger('datetime_block_id');
            $table->unsignedBigInteger('train_block_id')->unique();
            $table->foreign('datetime_block_id')->references('id')->on('datetime_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('train_block_id')->references('id')->on('train_block')
                ->onDelete('cascade')->onUpdate('restrict');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datetime_block');
    }
}
