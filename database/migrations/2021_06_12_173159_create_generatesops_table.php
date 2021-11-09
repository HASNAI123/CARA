<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneratesopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generatesops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('sop_title')->nullable();
            $table->string('business_unit')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('uploaded_by')->nullable();
             $table->string('Employee_id')->nullable();
            $table->string('status')->default('Pending');
            $table->string('deleted_at')->nullable();
            $table->string('Sop_file')->nullable();
            $table->date('effective_date')->nullable();
            $table->string('version_no')->nullable();
            $table->string('doc_no')->nullable();
            $table->longText('policy')->nullable();
            $table->longText('purpose')->nullable();
            $table->longText('scope')->nullable();
            $table->longText('review_pro')->nullable();
            $table->longText('monitoring')->nullable();
            $table->longText('verification')->nullable();
            $table->json('steps')->nullable();
            $table->json('desc')->nullable();
            $table->string('folder')->nullable();
            $table->string('revised by')->nullable();
            $table->string('edited_by')->nullable();
            $table->longText('img')->nullable();
            $table->longText('appendix')->nullable();
            $table->string('Process_owner')->nullable();
            $table->string('Process_exec')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('generatesops');
    }
}
