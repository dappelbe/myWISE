<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExercisePlanner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('explan', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->integer('repeatnum');
            $table->string('ltgoal');
            $table->string('smartgoal');
            $table->string('exwhere');
            $table->string('exwhen');
            $table->string('exalternative');
            $table->string('physioname');
            $table->integer('previousachieved');
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
        Schema::dropIfExists('explan');
    }
}
