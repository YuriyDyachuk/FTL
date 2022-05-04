<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehouseCargoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_cargo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->comment('Груз');
            $table->string('weight')->nullable()->comment('Масса, кг');
            $table->string('volume')->nullable()->comment('Объём, м3');
            $table->string('download_type')->nullable()->comment('Тип Загрузки');
            $table->string('pallet_size')->nullable()->comment('Размер Паллет при погрузке');
            $table->string('pallets_amount')->nullable()->comment('Кол-во Паллет');
            $table->string('places_amount')->nullable()->comment('Кол-во мест');
            $table->json('getting_acts')->nullable();
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
        Schema::dropIfExists('warehouse_cargo');
    }
}
