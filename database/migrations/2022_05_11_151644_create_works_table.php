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
            $table->integer('member1');
            $table->string('member1_name');
            $table->integer('member2')->nullable();
            $table->string('member2_name')->nullable();
            $table->integer('member3')->nullable();
            $table->string('member3_name')->nullable();
            $table->text('memo')->nullable();
            $table->tinyinteger('status')->default(1);
            $table->integer('user_id');
            $table->integer('project_id');
            $table->string('project_name');
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
