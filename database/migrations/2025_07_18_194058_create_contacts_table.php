<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->char('contact', 9)->unique();
            $table->string('email')->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
