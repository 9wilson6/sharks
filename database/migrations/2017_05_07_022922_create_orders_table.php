<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('tutor_id')->nullable();
            $table->string('subject');
            $table->string('title');
            $table->timestamp('homedate');
            $table->string('numpages');
            $table->string('format');
            $table->string('budget');
            $table->text('description');
            $table->string('level');
            $table->string('status')->default(1);            
            $table->string('agreed_amount')->nullable();            
            $table->string('date_awarded')->nullable();
            $table->string('date_completed')->nullable();
            $table->timestamps();
        });
        DB::update("ALTER TABLE orders AUTO_INCREMENT = 8695;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
