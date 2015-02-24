<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('content');
			$table->integer('post_id')->unsigned();
			$table->integer('created_by')->unsigned();
			$table->timestamps();
		});

		Schema::table('comments', function(Blueprint $table)
		{
			$table->foreign('post_id')->references('id')->on('posts');
			$table->foreign('created_by')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('comments', function($t)
		{
			$t->dropForeign('comments_post_id_foreign');
			$t->dropForeign('comments_created_by_foreign');
		});

		Schema::drop('comments');
	}

}
