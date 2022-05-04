<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClientRequestFtlWhFromto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (['client_request_ftlwh_from', 'client_request_ftlwh_to'] as $item) {
            Schema::create($item, function(Blueprint $table){
                $table->bigIncrements('id');
                $table->string('unl_on')->nullable();
                $table->string('unl_cont_ktk_type')->nullable();
                $table->string('unl_cont_ktk_prefix')->nullable();
                $table->string('unl_cont_ktk_number')->nullable();
                $table->string('unl_cont_ktk_owner_name')->nullable();
                $table->string('unl_cont_ktk_owner_inn')->nullable();
                $table->boolean('client_has_container')->nullable();
                $table->string('client_container_place')->nullable();
                $table->string('tm_name')->nullable();
                $table->string('tm_code')->nullable();
                $table->string('tm_city')->nullable();
                $table->string('tm_address')->nullable();
                $table->string('tm_power_of_attorney_number')->nullable();
                $table->string('tm_power_of_attorney_scan')->nullable();
                $table->string('pickup_name')->nullable();
                $table->string('pickup_code')->nullable();
                $table->string('pickup_city')->nullable();
                $table->string('pickup_address')->nullable();
                $table->string('pickup_power_of_attorney_number')->nullable();
                $table->string('pickup_power_of_attorney_scan')->nullable();
                $table->string('unl_tr_name')->nullable();
                $table->string('unl_tr_code')->nullable();
                $table->string('unl_tr_address')->nullable();
                $table->string('unl_tr_railway_carriage_owner_name')->nullable();
                $table->string('unl_tr_railway_carriage_owner_inn')->nullable();
                $table->bigInteger('client_request_id')->unsigned();
                $table->foreign('client_request_id')->on('client_requests')->references('id')->onDelete('cascade')->onUpdate('restrict');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_request_ftlwh_from');
        Schema::dropIfExists('client_request_ftlwh_to');
    }
}
