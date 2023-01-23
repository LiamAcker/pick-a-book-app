<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookLibrariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_libraries', function (Blueprint $table) {
            $table->primary(['bookId', 'libraryId']);
            $table->foreignId('bookId')->constrained('books');
            $table->foreignId('libraryId')->constrained('libraries');
            $table->integer('stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_libraries');
    }
}
