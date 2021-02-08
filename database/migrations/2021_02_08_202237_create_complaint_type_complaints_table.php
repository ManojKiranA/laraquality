<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintTypeComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_type_complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_id')->references('id')->on('complaints');
            $table->foreignId('complaint_type_id')->references('id')->on('complaint_types');
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
        Schema::dropIfExists('complaint_type_complaints');
    }
}
