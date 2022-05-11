<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('schedule_start');
            $table->date('schedule_end');
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->text('member1');
            $table->text('member2')->nullable();
            $table->text('member3')->nullable();
            $table->text('member4')->nullable();
            $table->text('memo')->nullable();
            $table->tinyinteger('status')->default(1);
            $table->integer('user_id');
            $table->integer('project_id');
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
        Schema::dropIfExists('works');
    }
}
