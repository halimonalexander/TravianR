<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 100);
            $table->string('password', 100);
            $table->tinyInteger('tribe');
            $table->tinyInteger('access')->default(1);
            $table->integer('sit1')->default(0);
            $table->integer('sit2')->default(0);
            $table->integer('alliance')->default(0);
            $table->string('sessid', 100)->nullable();
            $table->string('act', 10)->nullable();
            $table->timestamp('protect')->nullable();
            $table->tinyInteger('quest', false, true)->nullable();
            $table->integer('quest_time')->nullable();
            $table->string('gpack', 255)->default('gpack/travian_default/');
            $table->float('cp', 14, 5)->default(1);
            $table->integer('Rc', false, true)->default(0);
            $table->tinyInteger('ok')->default(0);
            $table->bigInteger('clp', false, true)->default(0);
            $table->bigInteger('oldrank', false, true)->default(0);
            $table->integer('invited')->default(0);
            $table->unsignedMediumInteger('maxevasion')->default(0);
            $table->unsignedBigInteger('village_select')->nullable();
            $table->timestamps();
        });

        Schema::create('user_profile', function(Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->text('email');
            $table->tinyInteger('gender')->default(0);
            $table->date('birthday')->nullable();
            $table->text('location')->nullable();
            $table->text('desc1')->nullable();
            $table->text('desc2')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('user_statistic', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->integer('ap')->default(0);
            $table->integer('dp')->default(0);
            $table->integer('RR', false, true)->default(0);
            $table->integer('dpall')->default(0);
            $table->integer('apall')->default(0);
            $table->timestamp('updated_at')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('user_premium', function(Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->integer('gold', false, true)->default(0)->length(9);
            $table->integer('plus')->default(0);
            $table->integer('goldclub')->default(0);
            $table->integer('b1')->default(0);
            $table->integer('b2')->default(0);
            $table->integer('b3')->default(0);
            $table->integer('b4')->default(0);
            $table->timestamp('updated_at')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('user_friendslist', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('friend_id');
            $table->enum('status', ['wait', 'active'])->default('wait');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('friend_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('user_vacation', function(Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->string('vac_time', 255)->default('0');
            $table->tinyInteger('vac_mode', false, true)->default(0);
            $table->string('vactwoweeks', 255)->default('0');
            $table->timestamp('updated_at')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('user_reservations', function(Blueprint $table) {
            $table->increments('id');
            $table->string('username', 100);
            $table->string('password', 100);
            $table->text('email');
            $table->tinyInteger('tribe');
            $table->tinyInteger('location');
            $table->tinyInteger('invited');
            $table->string('act', 10);
            $table->string('act2', 5);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_vacation');
        Schema::dropIfExists('user_friendslist');
        Schema::dropIfExists('user_premium');
        Schema::dropIfExists('user_statistic');
        Schema::dropIfExists('user_profile');
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_reservations');
    }
};
