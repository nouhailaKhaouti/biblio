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
        Schema::create('genres_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('book_id')->unsigned();
            $table->unsignedBiginteger('genre_id')->unsigned();

            $table->foreign('book_id')->references('id')
                 ->on('books')->onDelete('cascade');
            $table->foreign('genre_id')->references('id')
                ->on('genres')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genres_books');
    }
};
