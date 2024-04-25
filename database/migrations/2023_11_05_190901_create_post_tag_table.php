<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            // $table->foreignId('post_id')->nullable()->constrained()->onDelete('cascade');
            // $table->foreignId('tag_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            // $table->softDeletes();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::disableForeignKeyConstraints();
        // DB::table('past_tag')->truncate();
        // Schema::enableForeignKeyConstraints();
        // Schema::dropIfExists('post_tag');
        // Schema::table('post_tag', function (Blueprint $table) {

        //     $table->softDeletes();
        // });
        Schema::dropIfExists('post_tag');
    }
}
