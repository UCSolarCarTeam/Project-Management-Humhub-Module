<?php
use humhub\compat\CActiveForm;
use yii\helpers\Html;
use yii\jui\DatePicker;

?>

<div class="modal-dialog modal-dialog-normal animated fadeIn">
    <div class="modal-content">

        <?php $form = CActiveForm::begin(); ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php if (Yii::$app->request->get('id') != null) : ?>
            <h4 class="modal-title"
                id="myModalLabel"><?php echo Yii::t('ProjectManagementModule.views_view_edit_project', '<strong>Edit</strong> project'); ?></h4>
            <?php else :?>
            <h4 class="modal-title"
                id="myModalLabel"><?php echo Yii::t('ProjectManagementModule.views_view_edit_project', '<strong>Create</strong> project'); ?></h4>
            <?php endif; ?>
        </div>


        <div class="modal-body">


            <div class="form-group">
                <label
                    for="Task_title"><?php echo Yii::t('ProjectManagementModule.views_view_edit_project', 'Project name'); ?></label>
                <?php echo $form->textArea($project, 'name', array('id' => 'itemTask', 'class' => 'form-control autosize', 'rows' => '1', 'placeholder' => Yii::t('ProjectManagementModule.views_view_edit_project', 'Project name'))); ?>
                <?php echo $form->error($project, 'name'); ?>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <div class="form-group">
                            <label
                                for="Task_preassignedUsers"><?php echo Yii::t('ProjectManagementModule.views_view_edit_project', 'Assign a project owner'); ?></label>
                            <?php echo $form->textField($project, 'ownerGuid', array('id' => 'ownerGuid', 'class' => 'form-control', 'placeholder' => Yii::t('ProjectManagementModule.views_view_edit_project', 'Assign an owner to this project.'))); ?>
                            <?php echo $form->error($project, 'ownerGuid'); ?>
                        </div>

                        <?php
                        echo humhub\modules\user\widgets\UserPicker::widget(array(
                            'model' => $project,
                            'inputId' => 'ownerGuid',
                            'attribute' => 'ownerGuid',
                            'userSearchUrl' => $this->context->contentContainer->createUrl('/space/membership/search', array('keyword' => '-keywordPlaceholder-')),
                            'maxUsers' => 1,
                            'placeholderText' => Yii::t('ProjectManagementModule.views_view_edit_project', 'Assign an owner')
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-12">
                    <?php echo Html::submitButton(Yii::t('ProjectManagementModule.views_view_edit_project', 'Save'), array('class' => 'btn btn-primary')); ?>

                    <button type="button" class="btn btn-primary"
                            data-dismiss="modal"><?php echo Yii::t('ProjectManagementModule.views_view_edit_project', 'Cancel'); ?></button>
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
