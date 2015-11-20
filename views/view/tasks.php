<?php

use yii\helpers\Html;
use humhub\modules\project_management\models\Tasks;
use humhub\modules\comment\models\Comment;

humhub\modules\project_management\Assets::register($this);
?>

<div class="panel panel-default">
<div class="panel-body">
<div class="task-list">
    <?php foreach($tasks as $task) : ?>
        <div>
        <?php echo $task->title; ?>
        </div>
    <?php endforeach ?>
</div>
</div>
</div>
