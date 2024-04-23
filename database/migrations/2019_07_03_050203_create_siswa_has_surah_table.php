<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswaHasSurahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_siswa_has_surah', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->unsignedBigInteger('siswa_id')->nullable();
            $table->unsignedBigInteger('surah_id')->nullable();
            $table->integer('ayat');
            $table->dateTime('date');
            $table->string('kelancaran')->nullable(); 
            $table->string('tajwid')->nullable(); 
            $table->string('makhraj')->nullable(); 
            $table->string('nilai')->nullable(); 
            $table->integer('banyak_halaman')->nullable(); 
            $table->text('note')->nullable();
            $table->string('group_ayat'); 
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        
            $table->foreign('siswa_id')
                ->references('id')
                ->on('tbl_siswa')
                ->onDelete('set null');
            
            $table->foreign('surah_id')
                ->references('id')
                ->on('tbl_surah')
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
        Schema::dropIfExists('tbl_siswa_has_surah');
    }
}
