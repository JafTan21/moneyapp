<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();;
            $table->timestamp('start')->nullable();;
            $table->timestamp('end')->nullable();;
            $table->string('sponsor')->nullable();
            $table->string('value')->nullable();;
            $table->string('progress')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->nullable();

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
        Schema::dropIfExists('projects');
    }
}