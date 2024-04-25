<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedInteger('status')->default(1);
            $table->unsignedBigInteger('votes')->default(0);
            // $table->unsignedBigInteger('category_id');
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('user_id');
            $table->longText('content');
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
        Schema::table('posts', function (Blueprint $table) {
            $table->softDeletes();
        });
        // Schema::dropIfExists('posts');
        // Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('posts');
        // Schema::enableForeignKeyConstraints();
    }
}
