<?php

use Illuminate\Database\Seeder;

class MenuSystemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_system')->insert([
            ['label' => 'Category', 'icon' => 'icon-grid', 'route' => 'category', 'parent_id' => '0', 'sort' => 0, 'show' => '1,2'],
            ['label' => 'Create Category', 'icon' => 'icon-plus', 'route' => 'category.create', 'parent_id' => '1', 'sort' => 1, 'show' => '1,2'],
            ['label' => 'All Category', 'icon' => 'icon-list', 'route' => 'category.index', 'parent_id' => '1', 'sort' => 2, 'show' => '1,2'],

            ['label' => 'Post', 'icon' => 'icon-book-open', 'route' => 'post', 'parent_id' => '0', 'sort' => 1, 'show' => '1,2'],
            ['label' => 'Create Post', 'icon' => 'icon-plus', 'route' => 'post.create', 'parent_id' => '4', 'sort' => 1, 'show' => '1,2'],
            ['label' => 'All Posts', 'icon' => 'icon-list', 'route' => 'post.index', 'parent_id' => '4', 'sort' => 2, 'show' => '1,2'],

            ['label' => 'Page', 'icon' => 'icon-notebook', 'route' => 'page', 'parent_id' => '0', 'sort' => 2, 'show' => '1,2'],
            ['label' => 'Create Page', 'icon' => 'icon-plus', 'route' => 'page.create', 'parent_id' => '7', 'sort' => 1, 'show' => '1,2'],
            ['label' => 'Create iStay', 'icon' => 'icon-note', 'route' => 'page.landing', 'parent_id' => '7', 'sort' => 1, 'show' => '1,2'],
            ['label' => 'Create Room', 'icon' => 'icon-note', 'route' => 'page.room', 'parent_id' => '7', 'sort' => 1, 'show' => '1,2'],
            ['label' => 'All Pages', 'icon' => 'icon-list', 'route' => 'page.index', 'parent_id' => '7', 'sort' => 2, 'show' => '1,2'],

            ['label' => 'Users', 'icon' => 'icon-user', 'route' => 'user', 'parent_id' => '0', 'sort' => 6, 'show' => '1'],
            ['label' => 'Create User', 'icon' => 'icon-user-follow', 'route' => 'user.create', 'parent_id' => '12', 'sort' => 1, 'show' => '1'],
            ['label' => 'All User', 'icon' => 'icon-users', 'route' => 'user.index', 'parent_id' => '12', 'sort' => 2, 'show' => '1'],

            ['label' => 'Themes', 'icon' => 'icon-globe', 'route' => 'setting', 'parent_id' => '0', 'sort' => 7, 'show' => '1,2'],
            ['label' => 'Menu', 'icon' => 'icon-diamond', 'route' => 'setting.menu', 'parent_id' => '15', 'sort' => 1, 'show' => '1,2'],
            ['label' => 'Setting', 'icon' => 'icon-settings', 'route' => 'setting.index', 'parent_id' => '15', 'sort' => 2, 'show' => '1,2'],

            ['label' => 'Comment', 'icon' => 'icon-bubble', 'route' => 'comment', 'parent_id' => '0', 'sort' => 3, 'show' => '1,2'],
            ['label' => 'Create comment', 'icon' => 'icon-plus', 'route' => 'comment.create', 'parent_id' => '18', 'sort' => 1, 'show' => '1,2'],
            ['label' => 'All', 'icon' => 'icon-list', 'route' => 'comment.index', 'parent_id' => '18', 'sort' => 2, 'show' => '1,2'],

            ['label' => 'Services', 'icon' => 'icon-badge', 'route' => 'services', 'parent_id' => '0', 'sort' => 4, 'show' => '1,2'],
            ['label' => 'Create Services', 'icon' => 'icon-plus', 'route' => 'services.create', 'parent_id' => '21', 'sort' => 1, 'show' => '1,2'],
            ['label' => 'All', 'icon' => 'icon-list', 'route' => 'services.index', 'parent_id' => '21', 'sort' => 2, 'show' => '1,2'],

            ['label' => 'Contact', 'icon' => 'icon-envelope-open', 'route' => 'contact.index', 'parent_id' => '0', 'sort' => 5, 'show' => '1,2']
        ]);
    }
}
