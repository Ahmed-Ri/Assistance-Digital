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
        Schema::create('image_uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->text('filename');
            $table->unsignedBigInteger('compagne_id')->nullable();
            $table->timestamps();

            $table->foreign('compagne_id')->references('id')->on('compagnes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_uploads');
    }
};
