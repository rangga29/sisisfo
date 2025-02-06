<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sprs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dp_id')->constrained('departments')->restrictOnDelete();
            $table->foreignId('pr_id')->constrained('problems')->restrictOnDelete();
            $table->foreignId('sender_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('assigned_id')->nullable()->constrained('users')->restrictOnDelete();
            $table->string('spr_ucode')->unique();
            $table->string('spr_title');
            $table->enum('spr_status',['Terkirim','Diproses','Dibatalkan','Selesai'])->default('Terkirim');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sprs');
    }
};
