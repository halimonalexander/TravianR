<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('recipient_id');
            $table->unsignedInteger('sender_id');
            $table->string('topic', 100);
            $table->text('message');
            $table->unsignedInteger('report_id')->nullable();
            $table->boolean('is_viewed')->default(0);
            $table->boolean('is_archived')->default(0);
            $table->timestamps();
//            $table->boolean('send');
//            $table->unsignedInteger('deltarget');
//            $table->unsignedInteger('delowner');
//            $table->unsignedInteger('alliance');
//            $table->unsignedInteger('player');
//            $table->unsignedInteger('coor');

            $table->foreign('sender_id')->references('id')->on('users');
            $table->foreign('recipient_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
