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
        $projects = Projects::find()->contentContainer($this->contentContainer)->readable()->all(); // might need to change
        return $this->render('show', [
            'projects' => $projects,
            'contentContainer' => $this->contentContainer
        
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
            'tasks' => $tasks
            
        ]);
    }
    
    public function actionTasks()
    {
        Yii::$app->response->format = 'json';
        $json = array();
        $id = (int) Yii::$app->request->get('projectId');
        $json['output'] = $this->renderAjaxContent($this->renderTasks($id));
        return $json;
    }
    
    public function actionTest()
    {
        $project = $this->getProjectById((int) Yii::$app->request->get('projectId'));
        Yii::$app->response->format = 'json';
        $json = array();
        $json['output'] = $this->renderAjaxContent($this->actionProject());
        $json['wallEntryId'] = $project->id;
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
    
    public function actionEdit() {

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

}
