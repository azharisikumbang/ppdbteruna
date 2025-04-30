<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreviousSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previous_schools', function (Blueprint $table) {
            $table->id();
            $table->string('school_name');
            $table->string('certificate_number');
            $table->date('certificate_date');
            $table->string('skhun_number'); // SKHUN
            $table->foreignId('certificate_file_id')->nullable()->constrained('files');
            $table->foreignId('skhun_file_id')->nullable()->constrained('files');
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('previous_schools');
    }
}
