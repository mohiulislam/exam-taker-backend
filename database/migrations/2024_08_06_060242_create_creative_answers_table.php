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
        Schema::create('creative_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('answer_id')->constrained('answers')->onDelete('cascade');
            $table->foreignId('creative_question_id')->constrained('creative_questions')->onDelete('cascade');
            $table->text('answer_text');
            $table->integer('mark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creative_answers');
    }
};
