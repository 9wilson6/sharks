<?php

use Muyaedward\Messenger\Models\Models;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSharkupgradeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('email');
        });        

        Schema::table(Models::table('participants'), function (Blueprint $table) {
            $table->foreign('thread_id')->references('id')->on(Models::table('threads'))->onDelete('cascade');
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->string('homedate')->change();
        });

        Schema::table('revisions', function (Blueprint $table) {
            $table->string('provision')->change();
        });

        Schema::table('ratings', function (Blueprint $table) {
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->change();
            //$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');            
            $table->longText('comments')->nullable()->change();
            $table->boolean('publish')->default(false);
            $table->unsignedInteger('order_id')->index()->change();
        });

        Schema::table(Models::table('messages'), function (Blueprint $table) {
            $table->foreign('thread_id')->references('id')->on(Models::table('threads'))->onDelete('cascade');
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
