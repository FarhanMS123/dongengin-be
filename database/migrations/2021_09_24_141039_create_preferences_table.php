<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferences', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id');
            // status = NULL | finish | page_{index} | category
            $table->string('status')->nullable();
            $table->boolean('is_favorite')->default(false);
            $table->json('category')->nullable();
            $table->integer('rate')->nullable();
            $table->foreignId('story_id')->nullable();

            $table->timestamp('accessed_at')->useCurrent();

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
        Schema::dropIfExists('preferences');
    }
}
