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
            $table->integer('project_id')->unsigned()->nullable();
            $table->string('title');
            $table->text('description');
            $table->string('status');
            $table->string('assign')->nullable();
            $table->string('complete')->nullable();
            $table->date('startDate')->nullable();
            $table->date('dueDate')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')
                  ->references('id')->on('tasks')
                  ->onDelete('cascade');

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');;
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
