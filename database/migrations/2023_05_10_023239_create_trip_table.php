<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('driver_id')->unsigned();
            $table->bigInteger('vehicle_id')->unsigned();
            $table->date('date');
            $table->string('point_start');
            $table->string('point_end');
            $table->integer('distance');
            $table->integer('standard_time');
            $table->decimal('priceper_km', 11, 0);
            $table->integer('actual_time');
            $table->decimal('total_cost', 11, 0);
            $table->timestamps();

            $table->foreign('driver_id')->references('id')->on('driver')->onDelete('restrict');
            $table->foreign('vehicle_id')->references('id')->on('vehicle')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip');
    }
}
