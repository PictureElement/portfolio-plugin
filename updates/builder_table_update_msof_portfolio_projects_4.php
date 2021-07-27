<?php namespace msof\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMsofPortfolioProjects4 extends Migration
{
    public function up()
    {
        Schema::table('msof_portfolio_projects', function($table)
        {
            $table->boolean('published');
        });
    }
    
    public function down()
    {
        Schema::table('msof_portfolio_projects', function($table)
        {
            $table->dropColumn('published');
        });
    }
}
