<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tr_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company_name');
            $table->text('description');
            $table->text('location');
            $table->string('apply_link');
            $table->boolean('status');
            $table->date('expired_at');
            $table->timestamps();
        });

        Schema::create('tr_job_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('tr_jobs')->cascadeOnDelete();
            $table->string('requirement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_jobs');
        Schema::dropIfExists('tr_job_requirements');
    }
};
