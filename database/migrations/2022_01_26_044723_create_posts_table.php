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
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->string('text');
            $table->longText('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('file')->nullable();
            $table->string('file_type')->nullable();
            $table->integer('likes')->nullable();
            $table->integer('watch')->nullable();
            $table->string('status')->nullable();
            $table->date('future_date')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
