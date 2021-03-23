<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExerciseDiary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exdiary', function (Blueprint $table) {
            $table->id();
            $table->integer('userid')->default(-1);
            $table->integer('week')->default(-1);
            $table->integer('day')->default(-1);
            $table->date('calcdate');
            $table->integer('stretchingdone')->default(-1);
            $table->integer('strengtheningdone')->default(-1);
            $table->text('notes');
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
        Schema::dropIfExists('exdiary');
    }
}
