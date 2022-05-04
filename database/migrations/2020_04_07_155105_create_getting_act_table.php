<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGettingActTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('getting_act', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('responsible_user_id');

            $table->string('date')->nullable();
            $table->string('time')->nullable();

            $table->string('provider_name')->nullable();
            $table->string('provider_inn')->nullable();

            $table->string('client_name')->nullable();
            $table->string('client_inn')->nullable();

            $table->string('notes')->nullable();
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
        Schema::dropIfExists('getting_act');
    }
}
