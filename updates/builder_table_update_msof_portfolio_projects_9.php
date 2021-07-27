<?php namespace msof\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMsofPortfolioProjects9 extends Migration
{
    public function up()
    {
        Schema::table('msof_portfolio_projects', function($table)
        {
            $table->integer('category_id')->unsigned();
        });
    }
    
    public function down()
    {
        Schema::table('msof_portfolio_projects', function($table)
        {
            $table->dropColumn('category_id');
        });
    }
}
