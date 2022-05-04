<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainLeadRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // create ktk_type_catalog
        Schema::create('ktk_type_catalog', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        // create packing size catalog
        Schema::create('packing_size_catalog', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('size');
            $table->timestamps();
        });

        // create train_lead_order_product
        Schema::create('train_lead_order_products_catalog', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('cargo');
            $table->string('weight');
            $table->string('amount');
            $table->timestamps();
        });

        // main table
        Schema::create('train_lead_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('lead_id')->unsigned();
            $table->date('order_date')->nullable();
            $table->string('client')->nullable();
            $table->bigInteger('ktk_type_id')->unsigned()->nullable();
            $table->string('size')->nullable();
            $table->string('packing_method')->nullable();
            $table->string('city_from')->nullable();
            $table->string('station_from')->nullable();
            $table->string('loading_address')->nullable();
            $table->string('loading_contact')->nullable();
            $table->string('loading_contact_phone')->nullable();
            //$table->string('forwarding');
            $table->date('loading_date')->nullable();
            $table->time('loading_time')->nullable();
            $table->string('city_to')->nullable();
            $table->string('station_to')->nullable();
            $table->string('unloading_address')->nullable();
            $table->string('unloading_contact')->nullable();
            $table->string('unloading_contact_phone')->nullable();
            $table->date('unloading_date')->nullable();
            $table->time('unloading_time')->nullable();
            $table->string('railway_carriage_ktk_owner')->nullable();
            $table->timestamps();
            $table->foreign('ktk_type_id')->references('id')->on('ktk_type_catalog')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('lead_id')->references('id')->on('leads')
                ->onDelete('cascade')->onUpdate('restrict');
        });

        Schema::create('train_lead_product-order', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('train_lead_order_id')->unsigned();
            $table->bigInteger('train_lead_product_id')->unsigned();
            $table->timestamps();
            $table->foreign('train_lead_order_id')->on('train_lead_orders')->references('id')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('train_lead_product_id')->on('train_lead_order_products_catalog')->references('id')
                ->onDelete('cascade')->onUpdate('restrict');
        });

        Schema::create('packing_size_catalog-order', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('train_lead_order_id')->unsigned();
            $table->bigInteger('packing_size_catalog_id')->unsigned();
            $table->timestamps();
            $table->foreign('train_lead_order_id')->on('train_lead_orders')->references('id')
                ->onDelete('cascade')->onUpdate('restrict');
            $table->foreign('packing_size_catalog_id')->on('packing_size_catalog')->references('id')
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
        Schema::dropIfExists('ktk_type_catalog');
        Schema::dropIfExists('packing_size_catalog');
        Schema::dropIfExists('train_lead_order_products_catalog');
        Schema::dropIfExists('train_lead_orders');
        Schema::dropIfExists('train_lead_product-order');
        Schema::dropIfExists('packing_size_catalog-order');
    }
}
