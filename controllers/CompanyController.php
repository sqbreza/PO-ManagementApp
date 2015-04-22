<?php

namespace app\controllers;

use Yii;
use app\models\Company;
use app\models\CompanySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
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
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Company model.
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
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */



    public function actionCreate()
    {
        $model = new Company();

        if ($model->load(Yii::$app->request->post())) {

            if($_FILES['Company']['size']['quotation_header_image'] != 0){
                $model->quotation_header_image = UploadedFile::getInstance($model, 'quotation_header_image');
                $filename = 'IMG1'.date('Ymdhis') . '.' . $model->quotation_header_image->extension;
                $model->quotation_header_image->saveAs('uploads/q/' . $filename);
                $model->quotation_header_image = $filename;
            }

            if($_FILES['Company']['size']['quotation_watermark_image'] != 0){
                $model->quotation_watermark_image = UploadedFile::getInstance($model, 'quotation_watermark_image');
                $filename = 'IMG2'.date('Ymdhis') . '.' . $model->quotation_watermark_image->extension;
                $model->quotation_watermark_image->saveAs('uploads/q/' . $filename);
                $model->quotation_watermark_image = $filename;
            }

            if($_FILES['Company']['size']['bill_header_image'] != 0){
                $model->bill_header_image = UploadedFile::getInstance($model, 'bill_header_image');
                $filename = 'IMG3'.date('Ymdhis') . '.' . $model->bill_header_image->extension;
                $model->bill_header_image->saveAs('uploads/q/' . $filename);
                $model->bill_header_image = $filename;
            }

            if($_FILES['Company']['size']['bill_watermark_image'] != 0){
                $model->bill_watermark_image = UploadedFile::getInstance($model, 'bill_watermark_image');
                $filename = 'IMG4'.date('Ymdhis') . '.' . $model->bill_watermark_image->extension;
                $model->bill_watermark_image->saveAs('uploads/q/' . $filename);
                $model->bill_watermark_image = $filename;
            }

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }


        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {


        $model = $this->findModel($id);

        $quotation_header_image = $model->quotation_header_image;
        $quotation_watermark_image = $model->quotation_watermark_image;
        $bill_header_image = $model->bill_header_image;
        $bill_watermark_image = $model->bill_watermark_image;

        if ($model->load(Yii::$app->request->post())) {

            if($_FILES['Company']['size']['quotation_header_image'] != 0){
                unlink('uploads/q/'.$quotation_header_image);
                $model->quotation_header_image = UploadedFile::getInstance($model, 'quotation_header_image');
                $filename = 'IMG1'.date('Ymdhis') . '.' . $model->quotation_header_image->extension;
                $model->quotation_header_image->saveAs('uploads/q/' . $filename);
                $model->quotation_header_image = $filename;
            }else{
                $model->quotation_header_image = $quotation_header_image;
            }

            if($_FILES['Company']['size']['quotation_watermark_image'] != 0){
                unlink('uploads/q/'.$quotation_watermark_image);
                $model->quotation_watermark_image = UploadedFile::getInstance($model, 'quotation_watermark_image');
                $filename = 'IMG2'.date('Ymdhis') . '.' . $model->quotation_watermark_image->extension;
                $model->quotation_watermark_image->saveAs('uploads/q/' . $filename);
                $model->quotation_watermark_image = $filename;

            }else{
                $model->quotation_watermark_image = $quotation_watermark_image;
            }

            if($_FILES['Company']['size']['bill_header_image'] != 0){
                unlink('uploads/q/'.$bill_header_image);
                $model->bill_header_image = UploadedFile::getInstance($model, 'bill_header_image');
                $filename = 'IMG3'.date('Ymdhis') . '.' . $model->bill_header_image->extension;
                $model->bill_header_image->saveAs('uploads/q/' . $filename);
                $model->bill_header_image = $filename;


            }else{
                $model->bill_header_image = $bill_header_image;
            }

            if($_FILES['Company']['size']['bill_watermark_image'] != 0){
                unlink('uploads/q/'.$bill_watermark_image);
                $model->bill_watermark_image = UploadedFile::getInstance($model, 'bill_watermark_image');
                $filename = 'IMG4'.date('Ymdhis') . '.' . $model->bill_watermark_image->extension;
                $model->bill_watermark_image->saveAs('uploads/q/' . $filename);
                $model->bill_watermark_image = $filename;
            }else{
                $model->bill_watermark_image = $bill_watermark_image;
            }



            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }


        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Company model.
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
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
