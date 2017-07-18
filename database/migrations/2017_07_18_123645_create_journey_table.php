<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJourneyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journeys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('departure');
            $table->string('dep_time');
            $table->text('dep_comment')->nullable();
            $table->string('route');
            $table->text('r_comment')->nullable();
            $table->string('destination');
            $table->string('des_time');
            $table->text('des_comment')->nullable();
            $table->string('img1')->nullable();
            $table->string('img2')->nullable();
            $table->string('img3')->nullable();
            $table->string('img4')->nullable();
            $table->string('img5')->nullable();
            $table->string('img6')->nullable();
            $table->string('img7')->nullable();
            $table->string('img8')->nullable();
            $table->string('img9')->nullable();
            $table->string('img10')->nullable();
            $table->string('img11')->nullable();
            $table->string('img12')->nullable();
            $table->string('img13')->nullable();
            $table->string('img14')->nullable();
            $table->string('img15')->nullable();
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
        Schema::drop('journeys');
    }
}
