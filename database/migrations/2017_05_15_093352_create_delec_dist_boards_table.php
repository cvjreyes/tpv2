<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDelecDistBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delec_dist_boards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('zone_name');
            $table->string('item_name');
            $table->string('item_type');
            $table->integer('status_boards');
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
        Schema::dropIfExists('delec_dist_boards');
    }
}
