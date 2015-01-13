<?php

namespace app\controllers;

use Yii;
use app\models\Quotation;
use app\models\TemplateFields;
use app\models\QuationRef;
use app\models\QuotationSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\UploadedFile;

/**
 * QuotationController implements the CRUD actions for Quotation model.
 */
class QuotationController extends Controller
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
     * Lists all Quotation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuotationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    public function actionForm()
    {

        print_r($_POST);
        //print_r($_FILES);
        $isSave = true;

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();

        $supervisor_name = $_POST['supervisor_name'];
        $ref = $_POST['ref'];
        $user_id = $_POST['user_id'];
        $status = $_POST['status'];
        $template_ref = $_POST['template_ref'];
        $company_id = $_POST['company_id'];
        $client_company_id = $_POST['client_company_id'];
        $project_name = $_POST['project_name'];
        $po_no = $_POST['po_no'];
        $date = $_POST['date'];
        $grand_total = $_POST['grand_total'];
        $show_section_amount = $_POST['show_section_amount'];
        $note = $_POST['note'];

        $results = $_POST['section_name'];

        $file_name = '';

        if($_FILES['file']['size'] != 0){
            $file = UploadedFile::getInstanceByName('file');
            $ext = pathinfo($file, PATHINFO_EXTENSION);

            echo $file_name = 'ARC'.date('Ymdhis').'.'.$ext;

            if(!$file->saveAs('uploads/'.$file_name)){
                $isSave = false;
            }

        }

        try{

            foreach($results as $key=>$value){
                $section_name = $value;
                $field_names = $_POST[$section_name."_field_names"];
                $details = $_POST[$section_name."_details"];
                $costs = $_POST[$section_name."_costs"];
                $units = $_POST[$section_name."_units"];
                $total = $_POST[$section_name."_total"];

                foreach($field_names as $key=>$value){

                    $model = new QuationRef();

                    $model->quotation_ref = $ref;
                    $model->template_ref = $template_ref;
                    $model->section = $section_name;
                    $model->field_name = $field_names[$key];
                    $model->details = $details[$key];
                    $model->cost_day = $costs[$key];
                    $model->units = $units[$key];
                    $model->total = $total[$key];

                    if(!$model->save()) {
                        $isSave = false;
                    }
                }
            }

            $model = new Quotation();

            $model->ref = $ref;
            $model->project_name = $project_name;
            $model->company_id = $company_id;
            $model->client_company_id = $client_company_id;
            $model->amount = $grand_total;
            $model->po_no = $po_no;
            $model->date = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
            $model->status = $status;
            $model->user_id = $user_id;
            $model->supervisor_name = $supervisor_name;
            $model->show_section_amount = $show_section_amount;
            $model->file_name = $file_name;
            $model->note = $note;
            $model->created_time = date('Y-m-d H:i:s');

            if(!$model->save()) {
                $isSave = false;
            }


            if($isSave) {
                $transaction->commit();
                Yii::$app->getSession()->setFlash('error', 'Successfully Added !');
                return $this->redirect('create-quotation');
            }else{
                Yii::$app->getSession()->setFlash('error', 'An error occurred during submit process, Please submit again');
                return $this->redirect('create-quotation');
            }

        }catch (Exception $e){
            $transaction->rollback();
        }

    }

    public function actionCreateQuotation()
    {
       // $models = TemplateFields::findAll(['template_id'=>12]);
        $section = TemplateFields::find()->where(['template_id'=>12])->groupBy('section')->orderBy('id')->asArray()->all();
        $model = TemplateFields::find()->where(['template_id'=>12])->orderBy('id')->asArray()->all();
        return $this->render('create-quotation', [
            'section' => $section,
            'model' => $model,
            'id'=>12
        ]);



    }

    /**
     * Displays a single Quotation model.
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
     * Creates a new Quotation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Quotation();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Quotation model.
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
     * Deletes an existing Quotation model.
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
     * Finds the Quotation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Quotation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Quotation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
