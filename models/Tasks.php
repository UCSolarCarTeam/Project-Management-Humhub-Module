<?php

namespace humhub\modules\project_management\models;

use Yii;
use humhub\modules\user\models\User;
use humhub\modules\content\components\ContentActiveRecord;

/**
 * This is the model class for table "project_management_tasks".
 *
 * The followings are the available columns in table 'project_management_tasks':
 * @property integer $id
 * @property string $title
 * @property string $deadline
 * @property enum $priority
 * @property integer $project_id
 * @property string $created_at
 * @property integer $created_by
 **/
class Tasks extends ContentActiveRecord implements \humhub\modules\search\interfaces\Searchable
{

    public $ownerGuid = "";

    const PRIORITY_UNKNOWN = 1;
    const PRIORITY_BLOCKER = 2;
    const PRIORITY_CRITICAL = 3;
    const PRIORITY_MAJOR = 4;
    const PRIORITY_LOW = 5;
    const ISSUE_OPEN = 1;
    const ISSUE_CLOSED = 2;

    public static function tableName()
    {
        return 'project_management_tasks';
    }

    public function rules()
    {

        return array(
            array(['project_id', 'title', 'priority'], 'required'),
            array(['ownerGuid', 'project_id', 'description', 'deadline'], 'safe'),
        );
    }

    public function formName()
    {
        return 'Tasks';
    }

    public function beforeSave($insert)
    {
        if ($this->deadline == '')
        {
            $this->deadline = new \yii\db\Expression('NULL');
        }
        else
        {
            $this->deadline = Yii::$app->formatter->asDateTime($this->deadline, 'php:Y-m-d H:i:s');
        }

        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $guid = rtrim($this->ownerGuid, ',');
        if ($this->ownerGuid != null)
        {
            $user = User::findOne(['guid' => $guid]);
            $this->assignee = $user->id;
        }

    }

    public function beforeDelete()
    {
        return parent::beforeDelete();
    }

    public function getUrl()
    {
        return $this->content->container->createUrl('/project_management/views/tasks', array('id' => $this->id));
    }

    /**
     * @inheritdoc
     */
    public function getContentName()
    {
        return Yii::t('ProjectManagementModule.models_Tasks', "Tasks");
    }

    /**
     * @inheritdoc
     */
    public function getContentDescription()
    {
        return $this->title;
    }

    /**
     * @inheritdoc
     */
    public function getSearchAttributes()
    {
        return array(
            'id' => $this->id,
        );
    }

}
