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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('team');
            $table->boolean('life_flg')->default(true);
            $table->timestamps();

            // チームメンバーを登録するカラム（5人分）
            for ($i = 1; $i <= 5; $i++) {
                $table->unsignedBigInteger("user_id_$i")->nullable();
            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
