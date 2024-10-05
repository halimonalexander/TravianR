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
        Schema::create('oasises', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('world_cell_id')->comment('legacy name wref');
            $table->tinyInteger('type');
            $table->tinyInteger('high');
            $table->float('loyalty')->default(100);
            $table->unsignedInteger('conqueror')->nullable();
            $table->string('name', 100);
            $table->timestamps();

            $table->foreign('world_cell_id')->references('id')->on('world_cell')->onDelete('restrict');
            $table->foreign('conqueror')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('oasis_resources', function (Blueprint $table) {
            $table->unsignedInteger('oasis_id');
            $table->float('wood', 12, 2)->default(0);
            $table->float('clay', 12, 2)->default(0);
            $table->float('iron', 12, 2)->default(0);
            $table->float('crop', 12, 2)->default(0);
            $table->integer('max_storage')->default(800);
            $table->integer('max_granary')->default(800);
            $table->timestamp('updated_at');

            $table->foreign('oasis_id')->references('id')->on('oasises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oasises');
    }
};
