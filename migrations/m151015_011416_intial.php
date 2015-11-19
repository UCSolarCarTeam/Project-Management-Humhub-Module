<?php

use yii\db\Schema;
use yii\db\Migration;

class m151015_011416_intial extends Migration
{
    public function up()
    {
        $this->createTable('project_management_projects', array(
            'id' => 'pk',
            'name' => 'text NOT NULL',
            'project_owner' => 'int(11) NOT NULL',
                ), '');

        $this->createTable('project_management_assigned_users', array(
            'id' => 'pk',
            'user_id' => 'int(11) NOT NULL',
            'task_id' => 'int(11) NOT NULL',
            'project_id' => 'int(11) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'created_by' => 'int(11) NOT NULL',
                ), '');

        $this->createTable('project_management_tasks', array(
            'id' => 'pk',
            'title' => 'text NOT NULL',
            'deadline' => 'datetime DEFAULT NULL',
            'priority' => 'enum("unknown", "blocker", "critical", "major", "low") NOT NULL',
            'project_id' => 'int(11) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'created_by' => 'int(11) NOT NULL',
                ),  '');

        $this->createTable('project_management_messages', array(
            'id' => 'pk',
            'project_id' => 'int(11) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'created_by' => 'int(11) NOT NULL',
            'message' => 'text NOT NULL',
                ), '');

    }

    public function down()
    {
        echo "m151015_011416_intial cannot be reverted.\n";

        return false;
    }
}
