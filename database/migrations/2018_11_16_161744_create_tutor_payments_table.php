<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutor_payments', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('tutor_id')->unsigned()->index();
            $table->foreign('tutor_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('order_id')->unsigned()->index();
            $table->string('description')->nullable();
            $table->string('amount')->nullable();
            $table->string('fee')->nullable();
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
        Schema::dropIfExists('tutor_payments');
    }
}
