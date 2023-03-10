<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_headers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('memberId');
            $table->foreign('memberId')->references('id')->on('users')->onDelete('cascade')->onDelete('cascade');
            $table->date('date');
            $table->unsignedBigInteger('adminId')->nullable();
            $table->foreign('adminId')->references('id')->on('users')->onDelete('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('statusId');
            $table->foreign('statusId')->references('id')->on('statuses')->onDelete('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('libraryId');
            $table->foreign('libraryId')->references('id')->on('libraries')->onDelete('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('courierId')->nullable();
            $table->foreign('courierId')->references('id')->on('couriers')->onDelete('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('order_headers');
    }
}
