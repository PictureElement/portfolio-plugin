<?php namespace msof\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMsofPortfolioCategoryProject extends Migration
{
    public function up()
    {
        Schema::rename('msof_portfolio_categories_projects', 'msof_portfolio_category_project');
    }
    
    public function down()
    {
        Schema::rename('msof_portfolio_category_project', 'msof_portfolio_categories_projects');
    }
}
