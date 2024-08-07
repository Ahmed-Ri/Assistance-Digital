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
        Schema::create('compagnes', function (Blueprint $table) {
            $table->id();
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->string('status')->nullable();
            $table->string('objectif')->nullable();
            $table->json('reseaux')->nullable();
            $table->string('details')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
             
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compagnes');
    }
};
