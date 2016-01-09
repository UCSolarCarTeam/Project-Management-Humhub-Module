<?php
use humhub\compat\CActiveForm;
use yii\helpers\Html;
use yii\jui\DatePicker;
use humhub\modules\project_management\models\Tasks;

?>

<div class="modal-dialog modal-dialog-normal animated fadeIn">
    <div class="modal-content">

        <?php $form = CActiveForm::begin(); ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php if (Yii::$app->request->get('task_id') != null) : ?>
            <h4 class="modal-title"
                id="myModalLabel"><?php echo Yii::t('ProjectManagementModule.views_view_edit_task', '<strong>Edit</strong> task'); ?></h4>
            <?php else :?>
            <h4 class="modal-title"
                id="myModalLabel"><?php echo Yii::t('ProjectManagementModule.views_view_edit_task', '<strong>Create</strong> task'); ?></h4>
            <?php endif; ?>
        </div>


        <div class="modal-body">
            <div class="form-group">
                <label
                    for="Task_title"><?php echo Yii::t('ProjectManagementModule.views_view_edit_project', 'Task title'); ?></label>
                <?php echo $form->textArea($task, 'title', array('id' => 'itemTask', 'class' => 'form-control autosize', 'rows' => '1', 'placeholder' => Yii::t('ProjectManagementModule.views_view_edit_task', 'Task title'))); ?>
                <?php echo $form->error($task, 'title'); ?>
            </div>
            <div class="form-group">
                <label
                    for="Task_description"><?php echo Yii::t('ProjectManagementModule.views_view_edit_task', 'Task description'); ?></label>
                <?php echo $form->textArea($task, 'description', array('id' => 'itemTask', 'class' => 'form-control autosize', 'rows' => '1', 'placeholder' => Yii::t('ProjectManagementModule.views_view_edit_task', 'A short description of what this task involves'))); ?>
                <?php echo $form->error($task, 'description'); ?>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="form-group">
                            <label
                                for="Task_preassignedUsers"><?php echo Yii::t('ProjectManagementModule.views_view_edit_task', 'Assign a user'); ?></label>
                            <?php echo $form->textField($task, 'assignee', array('id' => 'ownerGuid', 'class' => 'form-control', 'placeholder' => Yii::t('ProjectManagementModule.views_view_edit_task', 'Assign a user to this task.'))); ?>
                            <?php echo $form->error($task, 'assignee'); ?>
                        </div>

                        <?php
                        echo humhub\modules\user\widgets\UserPicker::widget(array(
                            'model' => $task,
                            'inputId' => 'ownerGuid',
                            'attribute' => 'ownerGuid',
                            'userSearchUrl' => $this->context->contentContainer->createUrl('/space/membership/search', array('keyword' => '-keywordPlaceholder-')),
                            'maxUsers' => 1,
                            'placeholderText' => Yii::t('ProjectManagementModule.views_view_edit_project', 'Assign a user to this task')
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class ="form-group">
                        <label
                            for="Task_deadline"><?php echo Yii::t('ProjectManagementModule.views_view_edit_task', 'Deadline'); ?></label>
                        <?php
                        echo DatePicker::widget([
                            'model' => $task,
                            'attribute' => 'deadline',
                            'options' => [
                                'class' => 'form-control',
                                'id' => 'deadline',
                                'placeholder' => Yii::t('ProjectManagementModule.views_view_edit_task', 'Target date')
                            ]
                        ]);
                        ?>
                        <?php echo $form->error($task, 'deadline'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="Task_priority"><?php echo Yii::t('ProjectManagementModule.views_view_edit_task', 'Task priority'); ?></label>
                    <?php echo $form->dropDownList($task, 'priority', array(
                    Tasks::PRIORITY_UNKNOWN => Yii::t('ProjectManagementModule.views_view_edit_task', 'Unknown'),
                    Tasks::PRIORITY_BLOCKER => Yii::t('ProjectManagementModule.views_view_edit_task', 'Blocker'),
                    Tasks::PRIORITY_CRITICAL => Yii::t('ProjectManagementModule.views_view_edit_task', 'Critical'),
                    Tasks::PRIORITY_MAJOR => Yii::t('ProjectManagementModule.views_view_edit_task', 'Major'),
                    Tasks::PRIORITY_LOW => Yii::t('ProjectManagementModule.views_view_edit_task', 'Low'),
                        ),array('id' => 'reg_group', 'class' => 'form-control'));
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php echo $form->hiddenField($task, 'project_id', ['value' => $project_id]); ?>
                    <?php echo Html::submitButton(Yii::t('ProjectManagementModule.views_view_edit_task', 'Save'), array('class' => 'btn btn-primary')); ?>

                    <button type="button" class="btn btn-primary"
                            data-dismiss="modal"><?php echo Yii::t('ProjectManagementModule.views_view_edit_task', 'Cancel'); ?></button>
                    <?php if (Yii::$app->request->get('task_id') != null) : ?>
                    <a href="<?php echo $this->context->contentContainer->createUrl('show', ['delete' => true, 'task_id' => ($task->id + 1)]); ?>" class="btn btn-primary"
                        data-target="modal"><?php echo Yii::t('ProjectManagementModule.views_view_edit_task', 'Delete'); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php CActiveForm::end(); ?>


<script type="text/javascript">

    $('.autosize').autosize();

    $(document).ready(function () {
        var myInterval = setInterval(function () {
            $('#itemTask').focus();
            clearInterval(myInterval);
        }, 100);
    });

</script>
