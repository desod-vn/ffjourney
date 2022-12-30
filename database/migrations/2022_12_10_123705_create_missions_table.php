<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('description', 255)->nullable();
            $table->tinyInteger('mark')->unsigned()->nullable();
            $table->tinyInteger('repeat_type')->unsigned()->nullable();
            $table->tinyInteger('repeat_config')->unsigned()->nullable();
            $table->time('notify_at')->nullable();
            $table->date('start_at');
            $table->date('end_at')->nullable();
            $table->foreignId('mission_type_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missions');
    }
};
