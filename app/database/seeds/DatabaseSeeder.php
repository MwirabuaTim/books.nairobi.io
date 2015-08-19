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
		$this->call('UsersTableSeeder');
		$this->call('ForumsTableSeeder');
		$this->call('CollegesTableSeeder');
		$this->call('BookshelvesTableSeeder');
		$this->call('WishlistsTableSeeder');
		$this->call('BookshelvesTableSeeder');
		$this->call('BookshelvesTableSeeder');
		$this->call('CourselistsTableSeeder');
	}

}