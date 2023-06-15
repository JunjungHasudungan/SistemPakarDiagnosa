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
        Schema::create('kecanduan_solusi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kecanduan_id');
            $table->foreignId('solusi_id');
            $table->string('role')->default('pecandu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kecanduan_solusi');
    }
};
