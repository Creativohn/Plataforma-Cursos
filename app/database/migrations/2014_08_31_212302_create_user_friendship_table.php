<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFriendshipTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::table('user_friendship',function($table)
		{
			$table->create();
			$table->increments('id');
			$table->integer('userid_from');
			$table->integer('userid_to');
			$table->integer('friendship_status');
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
		//Schema::drop('user_friendship');
		//DB::table('user_friendship')->truncate();
	}

}
