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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('slug', 255);
            $table->string('image', 100);
            $table->text('content');
            $table->integer('category_id');
            $table->integer('user_id');
            $table->integer('status');
            $table->integer('views');
            $table->integer('is_featured');
            $table->date('s_date');
            $table->softDeletes();
            $table->text('description');
            $table->string('comment');
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
};
