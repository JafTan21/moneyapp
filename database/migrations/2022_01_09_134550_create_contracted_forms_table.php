<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractedFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracted_forms', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->string('unit_of_works')->nullable();
            $table->string('quantity_of_work')->nullable();
            $table->double('unit_rate')->nullable();
            $table->double('completed_quantity')->nullable();
            $table->double('total_amount')->nullable();
            $table->foreignId('project_id')->constrained();
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
        Schema::dropIfExists('contracted_forms');
    }
}