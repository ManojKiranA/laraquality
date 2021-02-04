<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_types', function (Blueprint $table) {
            $table->id();
            $table->string('name',250);
            $table->tinyInteger('critical_status')->nullable()->default(0);
            $table->boolean('department_id')->nullable()->references('id')->on('departments');
            $table->json('product_id')->nullable();
            $table->string('source',750)->nullable();
            $table->string('advice',750)->nullable();
            $table->foreignId('creator_id')->references('id')->on('users');
            $table->foreignId('updater_id')->nullable()->references('id')->on('users');
            $table->softDeletes('deleted_at', 0);
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
        Schema::dropIfExists('complaint_types');
    }
}
