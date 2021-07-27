<?php namespace msof\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMsofPortfolioProjects5 extends Migration
{
    public function up()
    {
        Schema::table('msof_portfolio_projects', function($table)
        {
            $table->boolean('published')->default(0)->change();
        });
    }
    
    public function down()
    {
        Schema::table('msof_portfolio_projects', function($table)
        {
            $table->boolean('published')->default(null)->change();
        });
    }
}
