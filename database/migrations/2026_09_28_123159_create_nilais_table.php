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
    Schema::create('nilais', function (Blueprint $table) {
        $table->id();
        $table->string('nim', 8);
        $table->string('nama');
        $table->string('mata_kuliah');
        $table->decimal('nilai', 5, 2);
        $table->string('keterangan');
        $table->string('grade', 1);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
