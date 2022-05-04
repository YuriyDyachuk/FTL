<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargoTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('cargo_name')->nullable()->comment('Груз');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('download_type')->nullable()->comment('Тип Загрузки');
            $table->string('pallet_size')->nullable()->comment('Размер Паллет при погрузке');
            $table->string('pallets_amount')->nullable()->comment('Кол-во Паллет');
            $table->string('places_amount')->nullable()->comment('Кол-во мест');
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
        Schema::dropIfExists('cargo_types');
    }
}
