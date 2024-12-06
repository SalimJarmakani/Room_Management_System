<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Employees Table
        Schema::create('employees', function (Blueprint $table) {
            $table->id('employee_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('organization_name');
            $table->string('position');
            $table->timestamps();
        });

        // Rooms Table
        Schema::create('rooms', function (Blueprint $table) {
            $table->id('room_id');
            $table->foreignId('employee_id')->constrained('employees', "employee_id")->onDelete('cascade');
            $table->string('room_name');
            $table->integer('capacity');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Bookings Table
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');
            $table->foreignId('room_id')->constrained('rooms', "room_id")->onDelete('cascade');
            $table->foreignId('employee_id')->constrained('employees', "employee_id")->onDelete('cascade');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->enum('bookingStatus', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->timestamps();
        });

        // Amenities Table
        Schema::create('amenities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Room Amenities Table
        Schema::create('room_amenities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('rooms', "room_id")->onDelete('cascade');
            $table->foreignId('amenity_id')->constrained('amenities')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_amenities');
        Schema::dropIfExists('amenities');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('employees');
    }
}
