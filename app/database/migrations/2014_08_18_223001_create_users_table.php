<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/*
		Schema::table('users',function($table)
		{
			$table->create();
			$table->increments('id');
			$table->integer('usergroup')->default('0');
			$table->string('validate_code', 42);
			$table->integer('validate_status');
			$table->string('realname', 150);
			$table->string('email', 100)->unique();
			$table->string('remember_token', 64);
			$table->string('password', 64);
			$table->timestamps();
		});
		*/
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Schema::drop('users');
		//DB::table('users')->truncate();
	}

}
