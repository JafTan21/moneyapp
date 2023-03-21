<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->timestamp('of')->nullable();
            $table->foreignId('project_id')->constrained();
            $table->string('material_name')->nullable();
            $table->string("material_group")->default(""); // 1. CIVIL 2. Electric 3. Tiles 4. Sanatary 5. Steel .. or more
            $table->double('quantity')->default(0);
            $table->double('rate')->default(0);
            $table->foreignId('supplier_id')->nullable()->constrained();
            $table->double('transporation_cost')->default(0);
            $table->double('labor_cost')->default(0);
            $table->foreignId('user_id')->constrained();
            $table->string('unit')->nullable(); //  Kgs , CFT , SQF , Meter , Inch , Feet , Tons .
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
        Schema::dropIfExists('materials');
    }
}
