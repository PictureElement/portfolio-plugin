<?php namespace Msof\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateMsofPortfolioCategoriesProjects extends Migration
{
    public function up()
    {
        Schema::create('msof_portfolio_categories_projects', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('c_id')->unsigned();
            $table->integer('p_id')->unsigned();
            $table->primary(['c_id','p_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('msof_portfolio_categories_projects');
    }
}
