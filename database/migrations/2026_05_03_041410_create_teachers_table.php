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
        Schema::create('ms_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('nip', 50)->unique();
            $table->string('photo')->nullable();
            $table->string('birth_place', 100);
            $table->date('birth_date');
            $table->date('join_date');
            $table->string('status', 50);
            $table->boolean('active')->default(true);
            $table->string('group', 50);
            $table->string('position', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_teachers');
    }
};
