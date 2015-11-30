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
        <div>
            <?php echo \humhub\widgets\AjaxButton::widget([
                'label' => '<button class="btn btn-default btn-block"><i class="fa fa-arrow-circle-o-right"></i> ' . $task->title . '</button>', 
                'tag' => 'a',
                'ajaxOptions' => [
                'dataType' => "json",
                'beforeSend' => "showDetails('" . $task->title . "', '" . $task->priority . "')",
                    ]
            ]);?>
        </div>
    <?php endforeach ?>
</div>
<?php if ( !empty($tasks) ) : ?>
<div id="task-details" class="well pull-right">  

    <p id="task-title"><?php echo 'Title'; ?></p>
    <p id="task-priority"><?php echo 'Priority'; ?></p>

</div>
    <?php endif; ?>
</div>
</div>

<script type="text/javascript">
    function showDetails(title, priority)
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
        // TODO: Add description to table and output
    }
</script>
