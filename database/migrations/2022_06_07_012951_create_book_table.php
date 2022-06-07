<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookTable extends Migration
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
            $table->string('name');
            $table->string('slug');
            $table->text('summary');
            $table->longText('description');
            $table->text('image');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->float('price');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('writer_id')->nullable();
            $table->unsignedBigInteger('publisher_id')->nullable();
            $table->foreign('category_id')->references('id')->on('category')->onDelete('SET NULL');
            $table->foreign('writer_id')->references('id')->on('writer')->onDelete('SET NULL');;
            $table->foreign('publisher_id')->reference('id')->on('publisher')->onDelete('SET NULL');
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
        Schema::dropIfExists('books');
    }
}
