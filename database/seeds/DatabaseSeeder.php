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
        $this->call(AttributesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MenuSystemTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(SystemLinkTypeTableSeeder::class);
    }
}
