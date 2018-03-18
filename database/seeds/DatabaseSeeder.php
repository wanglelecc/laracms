<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
		$this->call(WechatMenusTableSeeder::class);
		$this->call(WechatsTableSeeder::class);
//		$this->call(BlocksTableSeeder::class);
//		$this->call(LinksTableSeeder::class);
//		$this->call(ProjectsTableSeeder::class);
    }
}
