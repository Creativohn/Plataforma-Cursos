<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsergroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::table('usergroup',function($table)
		{
			$table->create();
			$table->increments('id');
			$table->integer('usergroup')->default('0');
			$table->string('usergroup_title', 42);
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
		//Schema::drop('usergroup');
		//DB::table('usergroup')->truncate();
	}

}
