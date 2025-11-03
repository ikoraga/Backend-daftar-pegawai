<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('nip', 20)->unique();
            $table->string('full_name', 120);
            $table->string('birth_place', 60)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('address', 255)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('npwp', 25)->nullable();
            $table->boolean('gender')->default(true);
            $table->string('religion_id', 26)->nullable();
            $table->string('rank_id', 26)->nullable();
            $table->string('echelon_id', 26)->nullable();
            $table->string('position_id', 26)->nullable();
            $table->string('unit_id', 26)->nullable();
            $table->string('photo_path', 255)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
