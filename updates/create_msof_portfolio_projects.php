<?php namespace Msof\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateMsofPortfolioProjects extends Migration
{
    public function up()
    {
        Schema::create('msof_portfolio_projects', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title')->nullable()->unsigned(false)->default(null)->change();
            $table->string('slug');
            $table->text('text')->nullable();
            $table->boolean('published')->default(0)->change();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->integer('category_id')->unsigned();
            $table->integer('sort_order')->default(0);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('msof_portfolio_projects');
    }
}
