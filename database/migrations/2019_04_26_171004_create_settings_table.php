<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('enabletelegram')->default('No');
            $table->string('telegramchatid')->nullable();
            $table->string('telegram_notify_level')->default(0);
            $table->string('sitename')->default('ExampleSite');
            $table->string('siteurl')->default('https://study.ace/');
            $table->string('siteemail')->default('support@example.net');
            $table->string('release_grace')->default('14');
            $table->string('levelone')->default(65);
            $table->string('leveltwo')->default(60);
            $table->string('levelthree')->default(55);
            $table->string('levelfour')->default(45);
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
        Schema::dropIfExists('settings');
    }
}
