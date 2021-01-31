<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->foreignId('manager_id')->nullable()->references('id')->on('users');
            $table->boolean('is_complaint')->nullable()->default(false);
            $table->boolean('is_production')->nullable()->default(false);
            $table->boolean('department_type')->nullable()->default(false);
            $table->boolean('department_id')->nullable()->references('id')->on('departments');
            $table->string('description',255)->nullable();
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
        Schema::dropIfExists('departments');
    }
}
