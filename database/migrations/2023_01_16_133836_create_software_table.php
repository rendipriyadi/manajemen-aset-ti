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
        Schema::create('software', function (Blueprint $table) {
            $table->id();
            $table->string('software_name');
            $table->string('software_category');
            $table->string('serial_number')->nullable();
            $table->string('license_amount')->nullable();
            $table->date('start_license')->nullable();
            $table->date('finish_license')->nullable();
            $table->string('no_pp')->nullable();
            $table->string('license_type')->nullable();
            $table->string('purchase_year')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('software');
    }
};
