<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserConfigurationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::table('user_configuration',function($table)
		{
			$table->create();
			$table->increments('id');
			$table->integer('userid');
			$table->string('email', 42);
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
		Schema::drop('user_configuration');
		//DB::table('usergroup')->truncate();
	}

}
