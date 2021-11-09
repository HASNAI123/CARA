<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Sop', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uploaded_by')->nullable();
            $table->string('sop_title')->nullable();
            $table->string('business_unit')->nullable();
            $table->string('sop_file')->nullable();
            $table->string('effective_date')->nullable();
            $table->string('Modified_by')->nullable();
            $table->string('Modified_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
