<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserGroupTable');
		//Usergroup::create(array('usergroup' => '0', 'usergroup_title' => 'user'));
	}

}

Class UserGroupTable extends Seeder{
	public function run()
	{
		$now = date('Y-m-d H:i:s');
		DB::table('usergroup')->insert(array(
			'usergroup' => '3',
			'usergroup_title' => 'Banned',
			'created_at' => $now,
            'updated_at' => $now,
		));
	}
}
