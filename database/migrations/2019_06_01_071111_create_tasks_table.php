<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('project_id')->unsigned();
            $table->string('title');
            $table->text('description');
            $table->string('status');
            $table->string('assign')->nullable();
            $table->string('approve')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')
                  ->references('id')->on('tasks')
                  ->onDelete('cascade');

            $table->foreign('project_id')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
