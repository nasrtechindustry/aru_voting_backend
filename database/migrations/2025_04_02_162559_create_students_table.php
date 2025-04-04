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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')
                ->nullable()->constrained('programs')
                ->onDelete('cascade')
                ->onUpdate('set null');
            $table->foreignId('user_id')
                ->nullable()->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('no action');
            $table->string('registration_number')->nullable();
            $table->timestamp('start_date')->nullable();    
            $table->timestamp('end_date')->nullable();    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
