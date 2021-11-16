<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaborsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labors', function (Blueprint $table) {
            $table->id();
            $table->timestamp('of')->nullable();
            $table->foreignId('project_id')->constrained();
            $table->integer('daily_worker')->nullable();
            $table->integer('daily_foreman')->nullable();
            $table->string('construction_group')->nullable();
            $table->string('group_leader')->nullable();
            $table->double('daily_labor_payment')->nullable();
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('labors');
    }
}