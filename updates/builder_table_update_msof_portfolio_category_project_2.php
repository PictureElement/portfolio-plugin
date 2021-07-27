<?php namespace msof\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMsofPortfolioCategoryProject2 extends Migration
{
    public function up()
    {
        Schema::table('msof_portfolio_category_project', function($table)
        {
            $table->dropPrimary(['c_id','p_id']);
            $table->integer('category_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->dropColumn('c_id');
            $table->dropColumn('p_id');
            $table->primary(['category_id','project_id']);
        });
    }
    
    public function down()
    {
        Schema::table('msof_portfolio_category_project', function($table)
        {
            $table->dropPrimary(['category_id','project_id']);
            $table->dropColumn('category_id');
            $table->dropColumn('project_id');
            $table->integer('c_id')->unsigned();
            $table->integer('p_id')->unsigned();
            $table->primary(['c_id','p_id']);
        });
    }
}
