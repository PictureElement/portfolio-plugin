<?php namespace msof\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMsofPortfolioProjects10 extends Migration
{
    public function up()
    {
        Schema::table('msof_portfolio_projects', function($table)
        {
            $table->text('location_attribute');
            $table->text('location_value');
        });
    }
    
    public function down()
    {
        Schema::table('msof_portfolio_projects', function($table)
        {
            $table->dropColumn('location_attribute');
            $table->dropColumn('location_value');
        });
    }
}
