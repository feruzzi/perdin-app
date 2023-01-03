<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('origin');
            $table->string('destination');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status');
            $table->text('description');
            $table->string('process_by')->nullable();
            $table->foreign('username')->references('username')->on('users');
            $table->foreign('origin')->references('id_city')->on('cities');
            $table->foreign('destination')->references('id_city')->on('cities');
            $table->foreign('process_by')->references('username')->on('users');
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
        Schema::dropIfExists('trips');
    }
};