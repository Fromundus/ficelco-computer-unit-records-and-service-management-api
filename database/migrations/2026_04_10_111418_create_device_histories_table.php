<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('device_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('device_id');
            $table->date('date_requested');
            $table->text('action');
            $table->date('date_performed');
            $table->unsignedBigInteger('performed_by_employeeid');
            $table->text('remarks');
            $table->timestamps();

            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_histories');
    }
};
