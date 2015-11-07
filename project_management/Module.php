<?php

namespace humhub\modules\project_management;

use Yii;
use yii\helpers\Url;
use humhub\modules\user\models\User;
use humhub\modules\space\models\Space;
use humhub\modules\content\components\ContentContainerActiveRecord;
use humhub\modules\content\components\ContentContainerModule;

class Module extends ContentContainerModule
{

    /**
     * @inheritdoc
     */
    public function getContentContainerTypes()
    {
        return [
            Space::className(),
        ];
    }
    
    public static function onSpaceMenuInit($event)
    {
        $space = $event->sender->space;
        if ($space->isModuleEnabled('project_management')) {
            $event->sender->addItem(array(
                'label' => Yii::t('ProjectManagementModule.base', 'Project Management'),
                'group' => 'modules',
                'url' => $space->createUrl('/project_management/view/show'),
                'icon' => '<i class="fa fa-file-text"></i>',
                'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'project_management'),
            ));
        }
    }
}

