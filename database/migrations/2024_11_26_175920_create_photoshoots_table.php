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
        Schema::create('photoshoots', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('cover_photo');
            $table->boolean('status')->default('published');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->decimal('price', 10, 2)->nullable();
            $table->timestamp('scheduled_at')->nullable();
            $table->string('location');
            $table->integer('duration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photoshoots');
    }
};
