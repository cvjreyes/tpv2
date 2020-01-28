<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHisoctrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hisoctrls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->integer('revision');
            $table->boolean('requested')->nullable();
            $table->boolean('requestedlead')->nullable();
            $table->boolean('issued')->nullable();
            $table->string('from');
            $table->string('to');
            $table->longText('comments');
            $table->string('user');
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
        //
    }
}
