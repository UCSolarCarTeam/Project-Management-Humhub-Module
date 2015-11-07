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
    Projects <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu">
        <?php foreach($projects as $project) : ?>
            <li>       
                <?php echo \humhub\widgets\AjaxButton::widget([
                    'label' => '<button class="btn btn-default btn-block"><i class="fa fa-arrow-circle-o-right"></i> ' . $project->name . '</button>', 
                    'tag' => 'a',
                    'ajaxOptions' => [
                        'dataType' => "json",
                        'beforeSend' => "function(data) { $('#selected-project').dropdown('toggle'); $('#selected-project').html('" . $project->name . "');}",
                        'success' => "function(json) {  $('#project-list').html(parseHtml(json.output)); }",
                        'url' => $contentContainer->createUrl('/project_management/view/tasks', array('projectId' => $project->id))
                    ]
                ]);?>
            </li>
        <?php endforeach ?>
        <a href="<?php echo $contentContainer->createUrl('edit'); ?>" class="btn btn-primary"
    data-target="#globalModal"><i class="fa fa-plus"></i> <?php echo Yii::t('ProjectManagementModule.views_view_show', 'Add Project'); ?></a>
    </ul>
        </button>
    </div>
    </div>
    <div class="panel-body pull-up">
    <?php
        echo \humhub\widgets\AjaxButton::widget([
            'label' => '<button class="btn btn-info header-button">Tasks</button>',
            'tag' => 'a',
            'ajaxOptions' => [
                'dataType' => "json",
                'beforeSend' => "function(data) { $('#project_1 .button-area').addClass('hidden');}",
                'success' => "function(json) {  $('#project_'+json.wallEntryId).html(parseHtml(json.output)); }",
                'url' => $contentContainer->createUrl('/project_management/view/test')
            ]
        ]);
        echo \humhub\widgets\AjaxButton::widget([
            'label' => '<button class="btn btn-info header-button">Discussion</button>',
            'tag' => 'a',
            'ajaxOptions' => [
                'dataType' => "json",
                'beforeSend' => "function(data) { $('#project_2 .button-area').addClass('hidden');}",
                'success' => "function(json) {  $('#project_'+json.wallEntryId).html(parseHtml(json.output)); }",
                'url' => $contentContainer->createUrl('/project_management/view/test')
            ]
        ]);
        echo \humhub\widgets\AjaxButton::widget([
            'label' => '<button class="btn btn-info header-button">Timeline</button>',
            'tag' => 'a',
            'ajaxOptions' => [
                'dataType' => "json",
                'beforeSend' => "function(data) { $('#project_3 .button-area').addClass('hidden');}",
                'success' => "function(json) {  $('#project_'+json.wallEntryId).html(parseHtml(json.output)); }",
                'url' => $contentContainer->createUrl('/project_management/view/test')
            ]
        ]);
        echo \humhub\widgets\AjaxButton::widget([
            'label' => '<button class="btn btn-info header-button">Settings</button>',
            'tag' => 'a',
            'ajaxOptions' => [
                'dataType' => "json",
                'beforeSend' => "function(data) { $('#project_4 .button-area').addClass('hidden');}",
                'success' => "function(json) {  $('#project_'+json.wallEntryId).html(parseHtml(json.output)); }",
                'url' => $contentContainer->createUrl('/project_management/view/test')
            ]
        ]);
    ?>


<div id="project-list">
</div>
<br>
</div>
</div>
