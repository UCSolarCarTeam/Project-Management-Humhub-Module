<?php

namespace humhub\modules\project_management\controllers;

use Yii;
use yii\web\HttpException;
use humhub\modules\content\components\ContentContainerController;
use humhub\modules\project_management\models\Tasks;
use humhub\modules\project_management\models\Projects;

class ViewController extends ContentContainerController
{

    public $hideSidebar = true;

    public function actionIndex()
    {
        return $this->render('show');
    }

    public function actionShow()
    {

        $delete = (bool) Yii::$app->request->get('delete');
        $project_id = (int) Yii::$app->request->get('project_id');
        $project_name = (string) Yii::$app->request->get('project_name');
        $task_id = (int) Yii::$app->request->get('task_id');
        $projects = Projects::find()->contentContainer($this->contentContainer)->readable()->all(); // might need to change
        return $this->render('show', [
            'projects' => $projects,
            'contentContainer' => $this->contentContainer,
            'delete' => $delete,
            'project_id' => $project_id,
            'project_name' => $project_name,
            'task_id' => $task_id

        ]);
    }

    public function actionProject()
    {
        return $this->renderPartial('project', [
            'contentContainer' => $this->contentContainer

        ]);

    }

    protected function renderTasks($id)
    {
        $tasks = Tasks::find()->where(['project_management_tasks.project_id' => $id])->all();
        return $this->renderPartial('tasks', [
            'contentContainer' => $this->contentContainer,
            'tasks' => $tasks,
            'id' => $id

        ]);
    }

    protected function renderDiscussion($id)
    {
        //TODO
    }

    public function actionTasks()
    {
        Yii::$app->response->format = 'json';
        $json = array();
        $id = (int) Yii::$app->request->get('projectId');
        $json['output'] = $this->renderAjaxContent($this->renderTasks($id));
        return $json;
    }

    protected function getProjectById($id)
    {
        $project = Projects::find()->contentContainer($this->contentContainer)->readable()->where(['project_management_projects.id' => $id])->one();
        if ($project === null) {
            throw new HttpException(404, "Could not load task!");
        }
        return $project;
    }

    public function actionEditproject() {

        $id = (int) Yii::$app->request->get('id');
        $project = Projects::find()->contentContainer($this->contentContainer)->readable()->where(['project_management_projects.id' => $id])->one();

        if ($project === null) {
            $project = new Projects();
            $project->content->container = $this->contentContainer;
        }


        if ($project->load(Yii::$app->request->post())) {
            if ($project->validate()) {
                if ($project->save()) {
                    return $this->htmlRedirect($this->contentContainer->createUrl('show'));
                }
            }
        }

        return $this->renderAjax('edit_project', ['project'=>$project]);

    }

    public function actionEdittask() {
        $id = (int) Yii::$app->request->get('task_id');
        $task = Tasks::find()->contentContainer($this->contentContainer)->readable()->where(['project_management_tasks.id' => $id])->one();
        $project_id = (int) Yii::$app->request->get('project_id');
        if ($task == null) {
            $task = new Tasks();
            $task->content->container = $this->contentContainer;
        }

        if ($task->load(Yii::$app->request->post())) {
            if ($task->validate()) {
                if ($task->save()) {
                    return $this->htmlRedirect($this->contentContainer->createUrl('show'));
                }
            }
        }

        return $this->renderAjax('edit_task', ['task'=>$task, 'project_id'=>$project_id]);

    }

    public function actionDeletetask() {

        $id = (int) Yii::$app->request->get('id');

        if ($id != 0) {
            $task = Tasks::find()->contentContainer($this->contentContainer)->where(['project_management_tasks.id' => $id])->one();
            if ($task) {
                $task->delete();
            }
        }

        Yii::$app->response->format='json';
        return ['status'=>'ok'];
    }

}
