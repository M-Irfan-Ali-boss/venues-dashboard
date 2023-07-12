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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('perfomed_by', ['staff', 'manager']);
            $table->enum('type', ['event_create', 'event_updated','event_deleted', 'assign_staff']);
            $table->string('name');
            $table->text('description');
            $table->softDeletes();

            $table->foreignId('manager_id')->nullable()->constrained('users');
            $table->foreignId('staff_id')->nullable()->constrained('users');

            $table->foreignId('veneus_id')->nullable()->constrained('venues');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};