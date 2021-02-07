<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->references('id')->on('customers');
            $table->foreignId('department_id')->references('id')->on('departments');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->date('register_date')->default(Carbon::now());
            $table->tinyInteger('status')->default(0);
            $table->string('description',750)->nullable();
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
        Schema::dropIfExists('complaints');
    }
}
