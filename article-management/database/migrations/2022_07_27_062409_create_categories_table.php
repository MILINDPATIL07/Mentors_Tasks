<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('categories', function (Blueprint $table) {
        $table->id();
        // For foreign key relationship with users table
        // $table->unsignedInteger('user_id');
        $table->string('cname');
        $table->enum('status', ['active','inactive'])->default('active');
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
        Schema::dropIfExists('categories');
    }
}