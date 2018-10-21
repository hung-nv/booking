<?php

use Illuminate\Database\Seeder;

class SystemLinkTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_link_type')->insert([
            ['name' => 'Category Details', 'prefix' => 'category'],

            ['name' => 'Post Details', 'prefix' => 'post'],

            ['name' => 'Page Details', 'prefix' => 'page'],

            ['name' => 'Landing', 'prefix' => '']
        ]);
    }
}
