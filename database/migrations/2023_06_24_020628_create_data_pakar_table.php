<?php

use App\Models\{
    Gejala,
    Kecanduan,
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
        Schema::create('data_pakar', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kecanduan::class);
            $table->foreignIdFor(Gejala::class)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pakar');
    }
};
