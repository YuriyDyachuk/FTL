<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderBlocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type');
            $table->integer('name');
            $table->integer('index');
            $table->unsignedBigInteger('lead_id');
            $table->integer('status');
            $table->unsignedBigInteger('responsible_user_id')->nullable();
            $table->unsignedBigInteger('active_responsible_user_id')->nullable();
            $table->unsignedBigInteger('responsible_chief_id')->nullable();
            $table->unsignedBigInteger('responsible_branch_chief_id')->nullable();
            $table->foreign('lead_id')->references('id')->on('leads')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });

        ####################################################################

        Schema::create('provider_block', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('city')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('driving_scheme')->nullable();
            $table->timestamps();
        });

        Schema::create('provider_block_report', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('provider_block_id')->unique();
            $table->foreign('provider_block_id')->references('id')->on('provider_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });

        Schema::create('provider_blocks_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('provider_block_id');
            $table->unsignedBigInteger('order_id');
            $table->unique(['provider_block_id', 'order_id']);
            $table->foreign('provider_block_id')->references('id')->on('provider_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('order_id')->references('id')->on('order')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });

        ####################################################################

        Schema::create('ftl_block', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('city')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('driving_scheme')->nullable();
            $table->timestamps();
        });

        Schema::create('ftl_block_report', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ftl_block_id')->unique();
            $table->foreign('ftl_block_id')->references('id')->on('ftl_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });

        Schema::create('ftl_blocks_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('ftl_block_id');
            $table->unsignedBigInteger('order_id');
            $table->unique(['ftl_block_id', 'order_id']);
            $table->foreign('ftl_block_id')->references('id')->on('ftl_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('order_id')->references('id')->on('order')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });

        ####################################################################

        Schema::create('terminal_block', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('city')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('driving_scheme')->nullable();
            $table->timestamps();
        });

        Schema::create('terminal_block_report', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('terminal_block_id')->unique();
            $table->foreign('terminal_block_id')->references('id')->on('terminal_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });

        Schema::create('terminal_blocks_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('terminal_block_id');
            $table->unsignedBigInteger('order_id');
            $table->unique(['terminal_block_id', 'order_id']);
            $table->foreign('terminal_block_id')->references('id')->on('terminal_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('order_id')->references('id')->on('order')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });

        ####################################################################

        Schema::create('client_block', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('city')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('driving_scheme')->nullable();
            $table->timestamps();
        });

        Schema::create('client_block_report', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_block_id')->unique();
            $table->foreign('client_block_id')->references('id')->on('client_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });

        Schema::create('client_blocks_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('client_block_id');
            $table->unsignedBigInteger('order_id');
            $table->unique(['client_block_id', 'order_id']);
            $table->foreign('client_block_id')->references('id')->on('client_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('order_id')->references('id')->on('order')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });

        ####################################################################

        Schema::create('train_block', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('city')->nullable();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->string('address')->nullable();
            $table->string('driving_scheme')->nullable();
            $table->timestamps();
        });

        Schema::create('train_block_report', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('train_block_id')->unique();
            $table->foreign('train_block_id')->references('id')->on('train_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });

        Schema::create('train_blocks_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('train_block_id');
            $table->unsignedBigInteger('order_id');
            $table->unique(['train_block_id', 'order_id']);
            $table->foreign('train_block_id')->references('id')->on('train_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('order_id')->references('id')->on('order')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });

        ####################################################################

        Schema::create('agent_block',  function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('fio')->nullable();
            $table->string('phone')->nullable();
            $table->string('num')->nullable()->comment('Доверенность №');
            $table->string('scan')->nullable()->comment('Доверенность Скан');
            $table->timestamps();
        });

        ####################################################################

        Schema::create('agent_provider_block',  function(Blueprint $table){
            $table->unsignedBigInteger('agent_block_id');
            $table->unsignedBigInteger('provider_block_id');
            $table->unique(['agent_block_id', 'provider_block_id']);
            $table->foreign('agent_block_id')->references('id')->on('agent_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('provider_block_id')->references('id')->on('provider_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });

        Schema::create('agent_ftl_block',  function(Blueprint $table){
            $table->unsignedBigInteger('agent_block_id');
            $table->unsignedBigInteger('ftl_block_id');
            $table->unique(['agent_block_id', 'ftl_block_id']);
            $table->foreign('agent_block_id')->references('id')->on('agent_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('ftl_block_id')->references('id')->on('ftl_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });

        Schema::create('agent_terminal_block',  function(Blueprint $table){
            $table->unsignedBigInteger('agent_block_id');
            $table->unsignedBigInteger('terminal_block_id');
            $table->unique(['agent_block_id', 'terminal_block_id']);
            $table->foreign('agent_block_id')->references('id')->on('agent_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('terminal_block_id')->references('id')->on('terminal_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });

        Schema::create('agent_train_block',  function(Blueprint $table){
            $table->unsignedBigInteger('agent_block_id');
            $table->unsignedBigInteger('train_block_id');
            $table->unique(['agent_block_id', 'train_block_id']);
            $table->foreign('agent_block_id')->references('id')->on('agent_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('train_block_id')->references('id')->on('train_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });

        Schema::create('agent_client_block',  function(Blueprint $table){
            $table->unsignedBigInteger('agent_block_id');
            $table->unsignedBigInteger('client_block_id');
            $table->unique(['agent_block_id', 'client_block_id']);
            $table->foreign('agent_block_id')->references('id')->on('agent_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('client_block_id')->references('id')->on('client_block')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('train_blocks_orders');
        Schema::dropIfExists('train_block_report');
        Schema::dropIfExists('train_block');

        Schema::dropIfExists('client_blocks_orders');
        Schema::dropIfExists('client_block_report');
        Schema::dropIfExists('client_block');

        Schema::dropIfExists('terminal_blocks_orders');
        Schema::dropIfExists('terminal_blocks_report');
        Schema::dropIfExists('terminal_block');

        Schema::dropIfExists('ftl_blocks_orders');
        Schema::dropIfExists('ftl_blocks_report');
        Schema::dropIfExists('ftl_block');

        Schema::dropIfExists('provider_blocks_orders');
        Schema::dropIfExists('provider_blocks_report');
        Schema::dropIfExists('provider_block');

        Schema::dropIfExists('agent_provider_block');
        Schema::dropIfExists('agent_ftl_block');
        Schema::dropIfExists('agent_terminal_block');
        Schema::dropIfExists('agent_train_block');
        Schema::dropIfExists('agent_client_block');

        Schema::dropIfExists('order');
    }
}
