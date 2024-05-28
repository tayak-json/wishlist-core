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
        Schema::create('user_wishes', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('wish_id')->unsigned();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('wish_id')
                ->references('id')->on('wishes')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_wishes');
    }
};
