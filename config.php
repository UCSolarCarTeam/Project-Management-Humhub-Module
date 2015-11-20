<?php

use humhub\modules\space\widgets\Menu;

return  [
        'id' => 'project_management',
        'class' => 'humhub\modules\project_management\Module',
        'namespace' => 'humhub\modules\project_management',
        'events' => [
                array( 'class' => Menu::className(), 'event' => Menu::EVENT_INIT, 'callback' => array('humhub\modules\project_management\Module', 'onSpaceMenuInit')),
                    ]
        ];
?>
