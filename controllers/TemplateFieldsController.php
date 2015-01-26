<?php

namespace app\controllers;

use Yii;
use app\models\Template;
use app\models\TemplateFields;
use app\models\TemplateFieldsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\HttpException;


if (!Yii::$app->user->can("moderate")) {
    throw new HttpException(403, 'You are not allowed to perform this action.');
}

/**
 * TemplateFieldsController implements the CRUD actions for TemplateFields model.
 */
class TemplateFieldsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all TemplateFields models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TemplateFieldsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTemplate($id)
    {

        $searchModel = new TemplateFieldsSearch();
        $dataProvider = $searchModel->template_search(Yii::$app->request->queryParams,$id);

        return $this->render('template', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreateTemplate()
    {
        return $this->render('create-template');
    }

    public function actionForm()
    {
        $isSave = true;

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();

        $results = $_POST['section_name'];
        $company_id = $_POST['company_id'];
        $template_name = $_POST['template_name'];
        $type = $_POST['type'];

        try{

            $model = new Template();
            $model->name = $template_name;
            $model->company_id = $company_id;
            $model->type = $type;
            if(!$model->save()) {
                $isSave = false;
            }
            $id = $model->id;


            foreach($results as $key=>$value){
                $section_name = $value;
                $field_names = $_POST["section".$key."_field_name"];

                foreach($field_names as $key=>$value){
                    $model = new TemplateFields();
                    $field_name = $value;
                    $model->template_id=$id;
                    $model->section=$section_name;
                    $model->field_name=$field_name;
                    $model->template_type=$type;

                    if(!$model->save()) {
                        $isSave = false;
                    }

                }
            }
            if($isSave) {
                $transaction->commit();
            }

        } catch(Exception $e) {
            $transaction->rollback();

        }

        return $this->redirect(['template', 'id' => $id]);
    }

    /**
     * Displays a single TemplateFields model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TemplateFields model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TemplateFields();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TemplateFields model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TemplateFields model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TemplateFields model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TemplateFields the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TemplateFields::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
