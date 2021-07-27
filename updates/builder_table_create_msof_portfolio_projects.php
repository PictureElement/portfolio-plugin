<?php namespace msof\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMsofPortfolioProjects extends Migration
{
    public function up()
    {
        Schema::create('msof_portfolio_projects', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('msof_portfolio_projects');
    }
}
