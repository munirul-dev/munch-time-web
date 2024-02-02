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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('menu_id');
            $table->integer('quantity')->default(0);
            $table->date('date');
            $table->float('amount_paid', 8, 2)->default(0);
            $table->string('description')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->timestamp('redeemed_at')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('menu_id')->references('id')->on('menus');
            
            $table->index('user_id');
            $table->index('student_id');
            $table->index('menu_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
