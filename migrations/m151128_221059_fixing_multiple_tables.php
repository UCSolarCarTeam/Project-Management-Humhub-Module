<?php

use yii\db\Schema;
use yii\db\Migration;

class m151128_221059_fixing_multiple_tables extends Migration
{
    public function up()
    {
        $this->addColumn('project_management_tasks','description', 'text');
        $this->addColumn('project_management_tasks', 'assignee', 'int(11) NOT NULL');
        $this->dropcolumn('project_management_assigned_users', 'task_id');
    }

    public function down()
    {
        echo "m151128_221059_fixing_multiple_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
