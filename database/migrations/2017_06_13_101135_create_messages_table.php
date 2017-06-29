<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages',function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->text('message');
            $table->integer('type')->default('1')->comment('1:text,2:pdf,3:zip,4:image');
            $table->string('file_path',150)->nullable();
            $table->string('file_name',150)->nullable();
            $table->timestamps();
            $table->integer('status')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
