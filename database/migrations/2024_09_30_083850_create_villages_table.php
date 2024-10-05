<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('villages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('world_cell_id')->comment('legacy name wref');
            $table->unsignedInteger('owner');
            $table->smallInteger('type')->default(0);
            $table->string('name', 100);
            $table->boolean('is_capital')->default(true);
            $table->boolean('is_natar')->default(false);
            $table->boolean('evasion')->default(false);
            $table->boolean('has_celebration')->default(false);
            $table->timestamps();

            $table->foreign('world_cell_id')->references('id')->on('world_cell')->onDelete('restrict');
            $table->foreign('owner')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('village_statistic', function (Blueprint $table) {
            $table->unsignedInteger('village_id');
            $table->integer('population')->default(0);
            $table->integer('culture_points')->default(0);
            $table->float('loyalty')->default(100);
            $table->timestamp('updated_at')->nullable();

            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
        });

        Schema::create('village_resources', function (Blueprint $table) {
            $table->unsignedInteger('village_id');
            $table->float('wood', 12, 2)->default(0);
            $table->float('clay', 12, 2)->default(0);
            $table->float('iron', 12, 2)->default(0);
            $table->float('crop', 12, 2)->default(0);
            $table->integer('max_storage')->default(800);
            $table->integer('max_granary')->default(800);
            $table->integer('starvation')->default(0);
            $table->timestamp('starvation_updated_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
        });

        Schema::create('village_exploration_slots', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('from');
            $table->unsignedInteger('to');
            $table->timestamp('created_at')->nullable();

            $table->foreign('from')->references('id')->on('villages')->onDelete('cascade');
            $table->foreign('to')->references('id')->on('villages')->onDelete('cascade');
        });

        Schema::create('village_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('village_id');
            $table->smallInteger('position');
            $table->smallInteger('type');
            $table->smallInteger('level')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('village_fields');
        Schema::dropIfExists('village_exploration_slots');
        Schema::dropIfExists('village_resources');
        Schema::dropIfExists('village_statistic');
        Schema::dropIfExists('villages');
    }
};
