<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->id();

            $table->string("title");
            $table->string("thumbnail");
            $table->string("routes");
            $table->string("description");
            $table->json("category");
            $table->integer("total_saved")->default(0);
            $table->integer("total_views")->default(0);
            $table->integer("total_favorites")->default(0);
            $table->integer("total_pages");

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
        Schema::dropIfExists('stories');
    }
}
