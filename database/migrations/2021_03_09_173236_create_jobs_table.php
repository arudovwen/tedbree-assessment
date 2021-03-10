<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->string('id');
            $table->string('title');
            $table->string('company');
            $table->string('company_logo')->nullable();
            $table->string('location');
            $table->string('category');
            $table->string('salary');
            $table->longText('description');
            $table->longText('benefits');
            $table->longText('type');
            $table->longText('work_condition');
            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
