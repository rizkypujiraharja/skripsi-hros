<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSallariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sallaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('month');
            $table->bigInteger('year');
            $table->bigInteger('basic_salary');
            $table->bigInteger('employer_pays_fee');
            $table->bigInteger('bonus');
            $table->bigInteger('performance_allowance');
            $table->bigInteger('overtime');
            $table->bigInteger('pph21');
            $table->bigInteger('jht');
            $table->bigInteger('bpjs');
            $table->bigInteger('position_allowance');
            $table->bigInteger('receivable_employee');
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
        Schema::dropIfExists('sallaries');
    }
}
