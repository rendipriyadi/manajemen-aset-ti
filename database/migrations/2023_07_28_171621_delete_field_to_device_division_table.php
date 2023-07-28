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
        Schema::table('device_division', function (Blueprint $table) {
            $table->dropColumn('department_id');
            $table->dropColumn('section_id');
            $table->dropColumn('device_pc_id');
            $table->dropColumn('device_monitor_id');
            $table->dropColumn('device_additional_id');
            $table->dropColumn('software_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('device_division', function (Blueprint $table) {
            $table->bigInteger('department_id');
            $table->bigInteger('section_id');
            $table->string('device_pc_id')->nullable();
            $table->string('device_monitor_id')->nullable();
            $table->string('device_additional_id')->nullable();
            $table->string('software_id')->nullable();
        });
    }
};
