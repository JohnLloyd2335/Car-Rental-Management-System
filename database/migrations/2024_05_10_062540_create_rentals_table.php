<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained('cars')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('status', ['Pending', 'Active', 'Cancelled', 'Overdue', 'Completed']);
            $table->boolean('is_paid')->default(false);
            $table->double('amount_paid', 5, 2)->nullable();
            $table->dateTime('date_paid')->nullable();
            $table->double('penalties', 5, 2)->nullable();
            $table->string('cancellation_reason')->nullable();
            $table->dateTime('date_approved')->nullable();
            $table->dateTime('date_cancelled')->nullable();
            $table->dateTime('date_returned')->nullable();
            $table->dateTime('date_late_returned')->nullable();
            $table->dateTime('date_completed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
