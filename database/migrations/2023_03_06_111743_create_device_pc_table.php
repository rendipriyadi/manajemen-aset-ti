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
        Schema::create('device_pc', function (Blueprint $table) {
            $table->id();
            $table->string('motherboard_id');
            $table->string('processor_id');
            $table->string('hardisk_id');
            $table->string('ram_id');
            $table->string('no_asset');
            $table->string('name');
            $table->string('file')->nullable();
            $table->string('status')->nullable();
            $table->text('description')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('device_pc');
    }
};
