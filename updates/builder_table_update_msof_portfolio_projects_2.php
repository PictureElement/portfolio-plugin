<?php namespace msof\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMsofPortfolioProjects2 extends Migration
{
    public function up()
    {
        Schema::table('msof_portfolio_projects', function($table)
        {
            $table->string('title')->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('msof_portfolio_projects', function($table)
        {
            $table->text('title')->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
