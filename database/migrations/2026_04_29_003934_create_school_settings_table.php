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
        Schema::create('ms_school_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('name');
            $table->string('description');
            $table->enum('status', ['negeri', 'swasta']);
            $table->string('akreditasi');
            $table->string('profile_video');
            $table->string('location');
            $table->string('telephone');
            $table->string('email');

            $table->string('instagram_url');
            $table->string('facebook_url');
            $table->string('tiktok_url');
            $table->string('youtube_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_settings');
    }
};
