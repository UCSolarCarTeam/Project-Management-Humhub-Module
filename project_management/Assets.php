<?php

namespace humhub\modules\project_management;

use yii\web\AssetBundle;

class Assets extends AssetBundle
{

    public $css = [
        'project_management.css'
    ];

    public function init()
    {
        $this->sourcePath = dirname(__FILE__) . '/assets';
        parent::init();
    }

}
