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
        Schema::create('indicateurs', function (Blueprint $table) {
            $table->id();
            $table->integer('trafic_facebook')->nullable();
            $table->integer('trafic_instagram')->nullable();
            $table->integer('trafic_google')->nullable();
            $table->integer('trafic_site')->nullable();
            $table->decimal('note_facebook',8,1)->nullable();
            $table->decimal('note_instagram',8,1)->nullable();
            $table->decimal('note_google',8,1)->nullable();
            $table->decimal('note_site', 8, 1)->nullable();
            $table->integer('apparition_site')->nullable();
            $table->integer('apparition_facebook')->nullable();
            $table->integer('apparition_instagram')->nullable();
            $table->integer('followers_facebook')->nullable();
            $table->integer('followers_instagram')->nullable();
            $table->integer('followers_linkedin')->nullable();
            $table->integer('commentaire_facebook')->nullable();
            $table->integer('commentaire_instagram')->nullable();
            $table->integer('commentaire_google')->nullable();
            $table->integer('commentaire_site')->nullable();
            $table->string('observation')->nullable();
            $table->string('termes')->nullable();
            $table->date('date')->nullable();
            
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
        Schema::dropIfExists('indicateurs');
    }
};
