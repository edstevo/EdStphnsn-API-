<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->text('content');
			$table->integer('type');
			$table->boolean('draft')->default(true);
			$table->integer('created_by')->unsigned();
			$table->integer('updated_by')->unsigned();
			$table->integer('deleted_by')->nullable()->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::table('posts', function(Blueprint $table)
		{
			$table->foreign('created_by')->references('id')->on('users');
			$table->foreign('updated_by')->references('id')->on('users');
			$table->foreign('deleted_by')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('posts', function(Blueprint $table)
		{
			$table->dropForeign('posts_created_by_foreign');
			$table->dropForeign('posts_updated_by_foreign');
			$table->dropForeign('posts_deleted_by_foreign');
		});

		Schema::drop('posts');
	}

}
