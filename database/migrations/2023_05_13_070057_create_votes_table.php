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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("poll_id");
            $table->unsignedBigInteger("choice_id");
            $table->timestamps();

            
            $table->foreign("user_id")->references("id")->on("users")
            ->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("poll_id")->references("id")->on("polls")
            ->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("choice_id")->references("id")->on("choices")
            ->onUpdate("cascade")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
