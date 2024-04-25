<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_assessment_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('siswa_id')->nullable();
            $table->string('assessment');
            $table->string('range');
            $table->string('note');
            $table->dateTime('date');
            $table->unsignedInteger('kelancaran'); 
            $table->unsignedInteger('tajwid'); 
            $table->unsignedInteger('makhraj'); 
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
    
            $table->foreign('siswa_id')
                ->references('id')
                ->on('tbl_siswa')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_assessment_log');
    }
}
