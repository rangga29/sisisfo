<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spr_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spr_id')->constrained('sprs')->restrictOnDelete();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->string('spr_st_ucode')->unique();
            $table->longText('spr_st_description')->nullable();
            $table->json('spr_st_attachment')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
