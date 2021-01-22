<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewPropertiesToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('department_id')->nullable();
            $table->foreignId('job_description_id')->nullable();
            $table->tinyInteger('collar_type')->nullable();
            $table->foreignId('manager_id')->nullable();
            $table->json('directed_staff')->nullable();
            $table->string('citizen_id',50)->nullable();
            $table->tinyInteger('status')->nullable();
            $table->date('starting_date')->default(\Carbon\Carbon::now());
            $table->date('birthday_date')->nullable();
            $table->date('leaving_date')->nullable();
            $table->json('leaving_reason')->nullable();
            $table->string('blood_group',5)->nullable();
            $table->json('phone')->nullable();
            $table->string('address',750)->nullable();
            $table->json('emergency_contact')->nullable();
            $table->json('education_info')->nullable();
            $table->json('skill_info')->nullable();
            $table->json('additional_task')->nullable();
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
