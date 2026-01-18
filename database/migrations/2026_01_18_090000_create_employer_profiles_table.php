<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('employer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            
            $table->string('company_name');
            $table->string('industry')->nullable();
            $table->string('size')->nullable();
            $table->integer('year_founded')->nullable();
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('recruitment_email')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->text('culture')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employer_profiles');
    }
};
