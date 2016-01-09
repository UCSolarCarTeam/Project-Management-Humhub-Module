<?php

use yii\helpers\Html;
use humhub\modules\project_management\models\Projects;
use humhub\modules\project_management\models\Tasks;
use humhub\modules\comment\models\Comment;

humhub\modules\project_management\Assets::register($this);
?>

<div class="panel panel-default">
<div class="panel panel-header">
    <div>
    <button type="button" class="btn btn-primary dropdown-toggle btn-block" id="selected-project" data-toggle="dropdown">
    <?php if ( !empty($project_name) )
            echo $project_name;
          else
            echo 'Projects';
    ?> <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu">
        <?php foreach($projects as $project) : ?>
            <li>
                <a href="<?php echo $this->context->contentContainer->createUrl('show', ['project_id' => ($project->id + 1), 'project_name' => $project->name]); ?>" class="btn btn-default btn-block"
                        data-target="modal"><i class="fa fa-arrow-circle-o-right"></i><?php echo $project->name; ?></a>
            </li>
        <?php endforeach ?>
        <a href="<?php echo $contentContainer->createUrl('editproject'); ?>" class="btn btn-primary"
            data-target="#globalModal"><i class="fa fa-plus"></i> <?php echo Yii::t('ProjectManagementModule.views_view_show', 'Add Project'); ?></a>
    </ul>
        </button>
    </div>
    </div>
    <div class="panel-body pull-up">
    <?php

        if ($task_id - 1 > -1 && $delete == true)
        {
            $task_id = $task_id - 1;
            echo "<script type='text/javascript'> $(window).load(function(){ $('#myModal').modal('show'); }); </script>";
        }

        echo \humhub\widgets\AjaxButton::widget([
            'label' => '<button class="btn btn-info header-button">Tasks</button>',
            'tag' => 'a',
            'ajaxOptions' => [
                'dataType' => "json",
                'success' => "function(json) {  $('#project-list').html(parseHtml(json.output)); }",
                'url' => $contentContainer->createUrl('/project_management/view/tasks', array('projectId' => $project_id-1))
            ]
        ]);
        echo \humhub\widgets\AjaxButton::widget([
            'label' => '<button class="btn btn-info header-button">Discussion</button>',
            'tag' => 'a',
            'ajaxOptions' => [
                'dataType' => "json",
                'success' => "function(json) {  $('#project-list').html(parseHtml(json.output)); }",
                'url' => $contentContainer->createUrl('/project_management/view/discussion', array('projectId' => $project_id-1))
            ]
        ]);
        echo \humhub\widgets\AjaxButton::widget([
            'label' => '<button class="btn btn-info header-button">Timeline</button>',
            'tag' => 'a',
            'ajaxOptions' => [
                'dataType' => "json",
                'success' => "function(json) {  $('#project-list').html(parseHtml(json.output)); }",
                'url' => $contentContainer->createUrl('/project_management/view/timeline', array('projectId' => $project_id-1))
            ]
        ]);
        echo \humhub\widgets\AjaxButton::widget([
            'label' => '<button class="btn btn-info header-button">Settings</button>',
            'tag' => 'a',
            'ajaxOptions' => [
                'dataType' => "json",
                'success' => "function(json) {  $('#project-list').html(parseHtml(json.output)); }",
                'url' => $contentContainer->createUrl('/project_management/view/settings', array('projectId' => $project_id-1))
            ]
        ]);
    ?>
    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-dialog modal-dialog-extra-small animated pulse">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirm deletion</h4>
      </div>
      <div class="modal-body text-center"">
        <p>Are you sure you want to delete this task?</p>
      </div>
      <div class="modal-footer">
        <?php
            echo \humhub\widgets\AjaxButton::widget([
                'label' => 'Delete',
                'ajaxOptions' => [
                    'type' => 'POST',
                    'url' => $contentContainer->createUrl('deletetask', array('id' => $task_id)),
                ],
                'htmlOptions' => [
                    'return' => 'true',
                    'class' => 'btn btn-primary',
                    'data-dismiss' => 'modal'
                ]
            ]);
        ?>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
    </div>
  </div>
</div>

<div id="project-list">
</div>
<br>
</div>
