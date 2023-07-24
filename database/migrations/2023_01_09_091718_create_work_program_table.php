<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_program', function (Blueprint $table) {
            $table->id();
            $table->string('work_program');
            $table->string('year');
            $table->string('general');
            $table->string('technical')->nullable();
            $table->text('description')->nullable();
            $table->string('progress');
            $table->string('status');
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
        Schema::dropIfExists('work_program');
    }
};
