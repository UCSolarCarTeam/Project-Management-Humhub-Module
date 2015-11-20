<?php

namespace humhub\modules\project_management\models;

use Yii;
use humhub\modules\user\models\User;
use humhub\modules\content\components\ContentActiveRecord;
use humhub\modules\project_management\models\AssignedUser;
use humhub\modules\project_management\models\Tasks;

/**
 * This is the model class for table "project_management_projects".
 *
 * The followings are the available columns in table 'project_management_projects':
 * @property integer $id
 * @property string $name
 * @property integer $project_owner
 **/
class Projects extends ContentActiveRecord implements \humhub\modules\search\interfaces\Searchable
{

    public $ownerGuid = "";

    public static function tableName()
    {
        return 'project_management_projects';
    }

    public function formName()
    {
        return 'Projects';
    }

    public function rules()
    {
        return array(
            array(['name'], 'required'),
            array(['ownerGuid'], 'safe'),
        );
    }

    public function getProjectUsers()
    {
        $query = $this->hasMany(AssignedUsers::className(), ['project_id' => 'id']);
        return $query;
    }

    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'project_owner']);
    }
    
    public function getTasks()
    {
        $query = $this->hasMany(Tasks::className(), ['project_id' => 'id']);
        return $query;
    }

    public function beforeSave($insert)
    {

        $guid = rtrim($this->ownerGuid, ',');
        if ($this->ownerGuid != null)
        {
            $user = User::findOne(['guid' => $guid]);
            $this->project_owner = $user->id;
        }
            
    
        
        return parent::beforeSave($insert);
    }

    public function getUrl()
    {
        return $this->content->container->createUrl('/project_management/views/show', array('id' => $this->id));
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
    }


    /**
     * @inheritdoc
     */
    public function getContentName()
    {
        return Yii::t('ProjectManagementModule.models_Projects', 'Projects');
    }

    /**
     * @inheritdoc
     */
    public function getContentDescription()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getSearchAttributes()
    {
        return array(
            'name' => $this->name,
        );
    }

}
