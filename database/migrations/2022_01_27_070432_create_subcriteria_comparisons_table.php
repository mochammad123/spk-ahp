<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcriteriaComparisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcriteria_comparisons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('criteria_id');
            $table->foreignId('subcriteria_id');
            $table->foreignId('subcriteria2_id');
            $table->double('score', 8, 5);
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
        Schema::dropIfExists('subcriteria_comparisons');
    }
}
