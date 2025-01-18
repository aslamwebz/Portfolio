<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ai_conversations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->json('messages');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ai_conversations');
    }
};
