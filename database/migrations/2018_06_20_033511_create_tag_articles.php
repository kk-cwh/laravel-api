<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('tag_articles', function (Blueprint $table) {
		    $table->unsignedInteger('article_id')->comment('文章id ');
		    $table->unsignedInteger('tag_id')->comment('标签id ');
		    $table->primary(['tag_id', 'article_id']);
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::drop('tag_articles');
    }
}
