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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->text('bio')->nullable(); // 自己紹介
            $table->string('sex')->nullable(); // 性別
            $table->string('nickname')->nullable(); // ニックネーム
            $table->integer('roll_flg')->default(0); // ロールフラグ
            $table->unsignedBigInteger('team_id')->nullable(); // チームID

            // 外部キー制約（必要に応じて追加）
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('bio');
            $table->dropColumn('sex');
            $table->dropColumn('nickname');
            $table->dropColumn('roll_flg');
            $table->dropColumn('team_id');
        });
    }
};
