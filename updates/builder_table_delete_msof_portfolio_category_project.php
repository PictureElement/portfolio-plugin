<?php namespace msof\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteMsofPortfolioCategoryProject extends Migration
{
    public function up()
    {
        Schema::dropIfExists('msof_portfolio_category_project');
    }
    
    public function down()
    {
        Schema::create('msof_portfolio_category_project', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('category_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->primary(['category_id','project_id']);
        });
    }
}
