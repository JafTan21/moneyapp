<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_contracts', function (Blueprint $table) {
            $table->id();
            $table->timestamp('of')->default(now());
            $table->foreignId('project_id')->constrained();
            $table->string('construction_group')->nullable();
            $table->string('leader')->nullable();
            $table->double('payment')->default(0);
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
        Schema::dropIfExists('sub_contracts');
    }
}