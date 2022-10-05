<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lands', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('owner_id')->unsigned()->nullable();
            $table->foreign('owner_id')->references('id')->on('land_owners')->onDelete('cascade');
            $table->string('mouja',191)->nullable();
            $table->string('kharij',191)->nullable();
            $table->string('bs_khotiyan',191)->nullable();
            $table->string('status',191)->default(1)->nullable();
            $table->string('updated_by')->nullable();
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('lands');
    }
}
