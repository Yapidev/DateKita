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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('date_id')->constrained('dates')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('paid_by')->nullable()->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('amount');
            $table->text('description')->nullable();
            $table->enum('card_header_color', ['primary', 'secondary', 'warning', 'success', 'danger'])->default('primary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
