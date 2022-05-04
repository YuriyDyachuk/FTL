<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargoReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_report', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Груз');
            $table->string('weight')->comment('Масса, кг');
            $table->string('volume')->comment('Объём, м3');
            $table->string('download_type')->comment('Тип Загрузки');
            $table->string('pallet_size')->comment('Размер Паллет при погрузке');
            $table->string('pallets_amount')->comment('Кол-во Паллет');
            $table->string('places_amount')->comment('Кол-во мест');
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
        Schema::dropIfExists('cargo_report');
    }
}
