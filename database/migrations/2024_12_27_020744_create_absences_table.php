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
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            // $table->date('date');
            // $table->time('time');
            $table->enum('attendance', ['present', 'sick', 'vacation', 'alpha']);
            $table->boolean('is_late');  //dibuat auto perhitungan time
            $table->unsignedBigInteger('last_division');
            $table->unsignedBigInteger('current_division');
            $table->unsignedBigInteger('id_employee');
            $table->unsignedBigInteger('shift_id');
            $table->foreign('current_division')->references('id')->on('divisions')->onDelete('cascade');
            $table->foreign('id_employee')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
