<?php

use yii\db\Migration;

class uninstall extends Migration
{

    public function up()
    {

        $this->dropTable('project_management_projects');
        $this->dropTable('project_management_assigned_users');
        $this->dropTable('project_management_tasks');
        $this->dropTable('project_management_messages');
    }

    public function down()
    {
        echo "uninstall does not support migration down.\n";
        return false;
    }

}

