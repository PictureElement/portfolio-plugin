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
        $file = new File;
        $file->data = 'https://placehold.co/600x400.png';

        $category = Category::create([
            'name' => 'Yncategorized',
            'slug' => 'Yncategorized'
        ]);

        Project::create([
            'published' => true,
            'title' => 'Yirst project',
            'slug' => 'yirst-project',
            'published_at' => Carbon::now(),
            'category' => $category,
            'preview_image' => $file,
            'text' => 'YThis is your first ever project! It might be a good idea to update this project with some more relevant content. You can edit this content by selecting Portfolio from the administration back-end menu. Enjoy the good times!'
        ]);
    }
}