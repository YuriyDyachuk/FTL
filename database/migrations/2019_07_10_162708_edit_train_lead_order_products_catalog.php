<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTrainLeadOrderProductsCatalog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('train_lead_order_products_catalog', function (Blueprint $table) {
            $table->bigInteger('train_lead_order_id')->unsigned()->after('id');
            $table->foreign('train_lead_order_id')->on('train_lead_orders')->references('id')
                ->onDelete('cascade')->onUpdate('restrict');
        });
        Schema::dropIfExists('train_lead_product-order');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
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
        Schema::table('train_lead_order_products_catalog', function (Blueprint $table) {
            $table->dropColumn('train_lead_order_id');
        });
    }
}
