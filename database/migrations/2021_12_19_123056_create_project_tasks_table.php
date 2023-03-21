<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamp('of')->nullable();
            $table->string('name');
            $table->foreignId('project_id')->constrained();
            $table->foreignId('user_id')->constrained();


            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->string('progress_rate')->nullable();
            $table->string('status')->nullable();

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
        Schema::dropIfExists('project_tasks');
    }
}