<?php

namespace humhub\modules\project_management\models;

use Yii;
use humhub\components\ActiveRecord;
use humhub\modules\user\models\User;
use humhub\modules\project_management\models\Tasks;

/**
 * This is the model class for table "project_management_assigned_user".
 *
 * The followings are the available columns in table 'project_management_assigned_user':
 * @property integer $id
 * @property string $task_id
 * @property string $space_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class TaskUser extends ActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return 'project_management_assigned_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array(['project_id', 'user_id'], 'required'),
            array(['project_id', 'user_id'], 'integer'),
        );
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        // TODO: add notification
    }

    public function beforeDelete()
    {
        // TODO: add notification
    }

}
