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
        Schema::create('client_photo_quantities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_photo_shoot_id')->constrained('client_photo_shoots')->onDelete('cascade');
            $table->foreignId('photo_id')->constrained('photos')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_photo_quantities');
    }
};
