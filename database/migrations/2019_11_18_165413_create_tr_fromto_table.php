<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrFromtoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientrequest_tr_fromto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('clientrequest_id')->unsigned();
            // Отправление:
            $table->date('from_date')->nullable();
            $table->string('from_city')->nullable();
            $table->string('from_contact_name')->nullable();
            $table->string('from_contact_phone')->nullable();
            $table->string('from_power_of_attorney_number')->nullable();
            $table->string('from_power_of_attorney_scan')->nullable();
            // Получение:
            $table->string('to_city')->nullable();
            $table->string('to_contact_name')->nullable();
            $table->string('to_contact_phone')->nullable();
            $table->string('to_power_of_attorney_number')->nullable();
            $table->string('to_power_of_attorney_scan')->nullable();
            $table->timestamps();
            $table->foreign('clientrequest_id')->on('clientrequest_tr_fromto')
                ->references('id')->onDelete('cascade')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientrequest_tr_fromto');
    }
}
