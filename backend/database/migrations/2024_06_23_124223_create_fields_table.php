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
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->text('field_name');
            $table->string('field_location');
            $table->string('field_type');
            $table->integer('field_size');
            $table->integer('number_of_players');
            $table->text('lighting_availability');
            $table->softDeletes()->nullable();
=======
            $table->string('name');
            $table->string('type');
            $table->string('location');
            $table->boolean('available');
>>>>>>> 6268d8a2836a053c3748f60ba4b621fce2e7c803
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fields');
    }
};
