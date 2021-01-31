<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('code',100);
            $table->foreignId('department_id')->nullable()->references('id')->on('departments');
            $table->foreignId('product_type_id')->nullable()->references('id')->on('product_types');
            $table->string('description',750)->nullable();
            $table->boolean('is_certified')->default(0);
            $table->foreignId('standard_id')->nullable()->references('id')->on('standards');
            $table->foreignId('creator_id')->references('id')->on('users');
            $table->foreignId('updater_id')->nullable()->references('id')->on('users');
            $table->timestamps();
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
        Schema::dropIfExists('products');
    }
}
