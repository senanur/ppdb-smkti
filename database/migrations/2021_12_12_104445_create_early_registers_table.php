<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEarlyRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('early_registers', function (Blueprint $table) {
            $table->id();
            $table->string('nm_student',100);
            $table->string('sch_student',50);
            $table->string('mjr_student_ft', 50);
            $table->string('mjr_student_snd', 50);
            $table->string('phn_student',13);
            $table->string('phn_parent',13);
            $table->text('addrs_student');
            $table->boolean('status')->nullable()->default(0);
            $table->string('reg_id', 15)->nullable();
            $table->date('reg_date');
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
        Schema::dropIfExists('early_registers');
    }
}
