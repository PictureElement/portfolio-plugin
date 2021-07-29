<?php namespace Msof\Portfolio\Updates;

use Carbon\Carbon;
use Msof\Portfolio\Models\Project;
use Msof\Portfolio\Models\Category;
use October\Rain\Database\Updates\Seeder;
use System\Models\File;

class SeedAllTables extends Seeder
{
    public function run()
    {
        $category = Category::create([
            'name' => 'Uncategorized',
            'slug' => 'uncategorized'
        ]);

        $project = Project::create([
            'published' => true,
            'title' => 'First project',
            'slug' => 'first-project',
            'published_at' => Carbon::now(),
            'preview_image' => plugins_path('msof/portfolio/assets/placeholder.png'),
            'category' => $category,
            'text' => 'This is your first ever project! It might be a good idea to update this project with some more relevant content. You can edit this content by selecting Portfolio from the administration back-end menu. Enjoy the good times!'
        ]);
    }
}