<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('library_id');
            $table->unsignedInteger('category_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('author');
            $table->string('image');
            $table->string('writer');
            $table->string('publisher');
            $table->timestamp('publisher_time', 0);
            // $table->string('isbn')->unique();
            $table->timestamps();

            // $table->foreign('library_id')->references('id')->on('libraries');
            // $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
