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
        Schema::create('confirm_requests', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->date('pickup_date');
            $table->date('return_date');
            $table->unsignedBigInteger('car_id');
            $table->integer('total_days');
            $table->decimal('total_amount', 10, 2);
            $table->string('driving_licence')->nullable();
            $table->string('national_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirm_requests');
    }
};
