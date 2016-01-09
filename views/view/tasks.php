<?php

use yii\helpers\Html;
use humhub\modules\project_management\models\Tasks;
use humhub\modules\comment\models\Comment;

humhub\modules\project_management\Assets::register($this);
?>

<div class="panel panel-default">
<div class="panel-body">
<div class="task-list pull-left">
    <?php foreach($tasks as $task) : ?>
        <div id="task_<?php echo $task->id ?>">
            <?php echo \humhub\widgets\AjaxButton::widget([
                'label' => '<button class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i> ' . $task->title . '</button>',
                'tag' => 'a',
                'ajaxOptions' => [
                'dataType' => "json",
                'beforeSend' => "showDetails('" . $task->title . "', '" . $task->priority . "', '" . $task->description . "')",
                    ]
            ]);?>
            <a href="<?php echo $contentContainer->createUrl('edittask', ['task_id' => $task->id, 'project_id' => $id]); ?>"
                class="tt"
                data-target="#globalModal" data-toggle="tooltip"
                data-placement="top" data-original-title="Edit Task"><i class="fa fa-file"></i></a>
        </div>
    <?php endforeach ?>
</div>
<?php if ( !empty($tasks) ) : ?>
<div id="task-details" class="well pull-right">

    <p id="task-title"><?php echo 'Title'; ?></p>
    <p id="task-priority"><?php echo 'Priority'; ?></p>
    <p id="task-description"><?php echo 'Description'; ?></p>

</div>
<?php endif; ?>
</div>
</div>
<div>
<a href="<?php echo $contentContainer->createUrl('edittask', ['project_id' => $id]); ?>" class="btn btn-primary"
    data-target="#globalModal"><i class="fa fa-plus"></i> <?php echo Yii::t('ProjectManagementModule.views_view_show', 'Add Task'); ?></a>
</div>

<script type="text/javascript">
    function showDetails(title, priority, description)
    {
        var str = "Priority: ";
        switch (priority) {
            case "unknown":
                str += "<i class='fa fa-question'></i> Unknown";
                break;
            case "minor":
                str += "<i class='fa fa-angle-down'></i> Minor";
                break;
            case "major":
                str += "<i class='fa fa-angle-up'></i> Major";
                break;
            case "critical":
                str += "<i class='fa fa-angle-double-up'></i> Critical";
                break;
            case "blocker":
                str += "<i class='fa fa-ban'></i> Blocker";
                break;

        }
        $('#task-title').html("Title: " + title);
        $('#task-priority').html(str);
        $('#task-description').html(description);
    }

    function clearDetails(task_id)
    {
        $('#task_' + task_id).fadeOut('fast')
        $('#task-title').html("Title");
        $('#task-priority').html("Priority");
        $('#task-description').html("Description");
    }
</script>
