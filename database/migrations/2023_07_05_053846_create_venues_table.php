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
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Private', 'Public']);
            $table->enum('status', ['Activated', 'Deactivated']);
            $table->string('name');
            $table->text('description');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('website');
            $table->string('address');
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamp('activated_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('manager_id')->nullable()->constrained('users');
            $table->foreignId('staff_id')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venues');
    }
};