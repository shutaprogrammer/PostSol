<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('ads', function (Blueprint $table) {
        $table->id();
        $table->string('title');       // 広告のタイトル
        $table->text('description');   // 広告の説明
        $table->string('image');       // 画像のパス
        $table->string('link');        // 広告のリンク先
        $table->timestamps();          // created_at, updated_at カラム
    });
}

public function down()
{
    Schema::dropIfExists('ads');
}
};
