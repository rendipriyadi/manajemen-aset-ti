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
        Schema::create('device_division', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('division_id');
            $table->bigInteger('department_id');
            $table->bigInteger('section_id');
            $table->string('device_pc_id')->nullable();
            $table->string('device_monitor_id')->nullable();
            $table->string('device_additional_id')->nullable();
            $table->string('device_more_id');
            $table->string('software_id')->nullable();
            $table->bigInteger('location_detail_id');
            $table->string('file')->nullable();
            $table->string('status')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('device_division');
    }
};
