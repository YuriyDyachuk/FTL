<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameLeadProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_product_download_types', function(Blueprint $table){
            $table->dropForeign('lead_product_download_types_product_id_foreign');
        });
        Schema::rename('lead_product_download_types', 'client_request_product_download_types');

        Schema::table('lead_products', function(Blueprint $table){
            $table->dropForeign('lead_products_client_request_id_foreign');
        });

        Schema::rename('lead_products', 'client_request_products');

        Schema::table('client_request_products', function(Blueprint $table){
            $table->foreign('client_request_id')->on('client_requests')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });

        Schema::table('client_request_product_download_types', function(Blueprint $table){
            $table->foreign('product_id')->on('client_request_products')->references('id')->onDelete('cascade')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
