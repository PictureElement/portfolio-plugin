<?php namespace Msof\Portfolio\Updates;

use Carbon\Carbon;
use Msof\Portfolio\Models\Project;
use Msof\Portfolio\Models\Category;
use October\Rain\Database\Updates\Seeder;

class SeedAllTables extends Seeder
{
    public function run()
    {
        Project::create([
            'title' => 'First project',
            'slug' => 'first-project',
            'text' => '
This is your first ever **project**! It might be a good idea to update this project with some more relevant content.
You can edit this content by selecting **Projects** from the administration back-end menu.
*Enjoy the good times!*
            ',
            'published' => true,
            'published_at' => Carbon::now(),
            'created_at' => Carbon::now()
        ]);

        Category::create([
            'name' => 'Uncategorized',
            'slug' => 'uncategorized'
        ]);
    }
}