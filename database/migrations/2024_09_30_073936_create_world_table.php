<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('world_cell', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('field_type')->default(0);
            $table->tinyInteger('oasis_type')->default(0);
            $table->integer('x');
            $table->integer('y');
            $table->boolean('occupied')->default(false);
            $table->string('image', 3);
            $table->timestamp('updated_at')->nullable();
            $table->comment('legacy name wdata');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('world');
    }
};
