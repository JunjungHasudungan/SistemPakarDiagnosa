<?php

use App\Models\{
    Kecanduan,
    User,
};
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
        Schema::create('temp_diagnosa', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable();
            $table->foreignIdFor(Kecanduan::class)->nullable();
            $table->unsignedBigInteger('gejala')->nullable();
            $table->unsignedBigInteger('gejala_terpenuhi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_diagnosa');
    }
};
