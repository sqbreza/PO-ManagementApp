<?php

namespace app\controllers;

use app\models\QuotationRef;
use Yii;
use app\models\Quotation;
use app\models\TemplateFields;
use app\models\QuationRef;
use app\models\FileArchive;
use app\models\QuotationSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

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
        $user_id = $_POST['user_id'];
        $status = $_POST['status'];
        $template_ref = $_POST['template_ref'];
        $company_id = $_POST['company_id'];
        $client_company_id = $_POST['client_company_id'];
        $project_name = $_POST['project_name'];
        $project_name_header = $_POST['project_name_header'];
        $po_no = $_POST['po_no'];
        $date = $_POST['date'];
        $grand_total = $_POST['grand_total'];
        $show_section_amount = $_POST['show_section_amount'];
        $note_up = $_POST['note_up'];
        $note_down = $_POST['note_down'];
        $results = $_POST['section_name'];

        $ref = Yii::$app->mycomponent->generateQuotationRef('Ice9','Quotation');



        try{


            if($_FILES['file']['size'][0] != 0){

                $files = UploadedFile::getInstancesByName('file');

                foreach($files as $key=>$file){

                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                    $file_name = 'ARC_Q'.date('Ymdhis').$key.'.'.$ext;

                    if(!$file->saveAs('uploads/'.$file_name)){
                        $isSave = false;
                    }

                    /*if($key ==0){
                        $file_name_temp .= $file_name;
                    }else{
                        $file_name_temp .= "|".$file_name;
                    }*/

                    $model = new FileArchive();

                    $model->ref = $ref;
                    $model->file_name = $file_name;
                    $model->type = "Quotation";

                    if(!$model->save()) {
                        $isSave = false;
                    }

                }


            }

            foreach($results as $key=>$value){
                $section_name = $value;
                $field_names = $_POST[$section_name."_field_names"];
                $details = $_POST[$section_name."_details"];
                $costs = $_POST[$section_name."_costs"];
                $units = $_POST[$section_name."_units"];
                $total = $_POST[$section_name."_total"];

                foreach($field_names as $key=>$value){

                    $model = new QuotationRef();

                    $model->ref = $ref;
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
            $model->project_name_header = $project_name_header;
            $model->company_id = $company_id;
            $model->client_company_id = $client_company_id;
            $model->amount = $grand_total;
            $model->po_no = $po_no;
            $model->date = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
            $model->status = $status;
            $model->user_id = $user_id;
            $model->supervisor_name = $supervisor_name;
            $model->show_section_amount = $show_section_amount;
            $model->note_up = $note_up;
            $model->note_down = $note_down;
            $model->template_ref = $template_ref;
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



    public function actionFormUpdate()
    {
        //print_r($_POST);

        $isSave = true;

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();

        $supervisor_name = $_POST['supervisor_name'];
        $model_id = $_POST['model_id'];
        $user_id = $_POST['user_id'];
        $status = $_POST['status'];
        $template_ref = $_POST['template_ref'];
        $company_id = $_POST['company_id'];
        $client_company_id = $_POST['client_company_id'];
        $project_name = $_POST['project_name'];
        $project_name_header = $_POST['project_name_header'];
        $po_no = $_POST['po_no'];
        $date = $_POST['date'];
        $grand_total = $_POST['grand_total'];
        $show_section_amount = $_POST['show_section_amount'];
        $note_up = $_POST['note_up'];
        $note_down = $_POST['note_down'];
        $results = $_POST['section_name'];

        $ref = $_POST['ref'];



        try{

            if($_FILES['file']['size'][0] != 0){

                $files = UploadedFile::getInstancesByName('file');

                foreach($files as $key=>$file){

                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                    $file_name = 'ARC_Q'.date('Ymdhis').$key.'.'.$ext;

                    if(!$file->saveAs('uploads/'.$file_name)){
                        $isSave = false;
                    }


                    $model = new FileArchive();

                    $model->ref = $ref;
                    $model->file_name = $file_name;
                    $model->type = "Quotation";

                    if(!$model->save()) {
                        $isSave = false;
                    }

                }


            }

            QuotationRef::deleteAll('ref = :ref', [':ref' => $ref]);

            foreach($results as $key=>$value){
                $section_name = $value;
                $field_names = $_POST[$section_name."_field_names"];
                $details = $_POST[$section_name."_details"];
                $costs = $_POST[$section_name."_costs"];
                $units = $_POST[$section_name."_units"];
                $total = $_POST[$section_name."_total"];

                foreach($field_names as $key=>$value){

                    $model = new QuotationRef();

                    $model->ref = $ref;
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

            $model = Quotation::findOne($model_id);

            $model->ref = $ref;
            $model->project_name = $project_name;
            $model->project_name_header = $project_name_header;
            $model->company_id = $company_id;
            $model->client_company_id = $client_company_id;
            $model->amount = $grand_total;
            $model->po_no = $po_no;
            $model->date = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
            $model->status = $status;
            $model->user_id = $user_id;
            $model->supervisor_name = $supervisor_name;
            $model->show_section_amount = $show_section_amount;
            $model->note_up = $note_up;
            $model->note_down = $note_down;
            $model->template_ref = $template_ref;
            $model->created_time = date('Y-m-d H:i:s');



            if(!$model->save()) {
                $isSave = false;
            }


            if($isSave) {

                $transaction->commit();
                Yii::$app->getSession()->setFlash('error', 'Successfully Added !');
                return $this->redirect('view-quotation?id='.$model_id);
            }else{

                Yii::$app->getSession()->setFlash('error', 'An error occurred during submit process, Please submit again');
                return $this->redirect('view-quotation?id='.$model_id);
            }

        }catch (Exception $e){
            $transaction->rollback();
        }



    }

    public function actionDeleteFile()
    {
         $file_name = $_GET['file_name'];
         $id = $_GET['id'];

        if (!unlink('uploads/'.$file_name)) {
            return false;
        }else{
            if(FileArchive::deleteAll('file_name = :file_name', [':file_name' => $file_name])){
                return $this->redirect(Yii::getAlias('@web').'/quotation/view-quotation?id='.$id);
            }
        }

    }

    public function actionDeleteFiles()
    {

        $file_name = $_POST['filename'];
        $ref = $_POST['ref'];
        if (!unlink('uploads/'.$file_name)) {
            return false;
        }else{
            FileArchive::deleteAll('file_name=:file_name',['file_name'=>$file_name]);
            $files = FileArchive::find()->where('ref=:ref',['ref'=>$ref])->asArray()->all();
            echo json_encode($files);
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
            'id'=>12,
            'user_id'=>1,
        ]);


    }

    public function actionViewQuotation($id)
    {

        return $this->render('view-quotation', [
            'model' => $this->findModel($id),
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

    public function actionTest()
    {
        $company = 'Ice9';
        $type = 'Quotation';
        echo Yii::$app->mycomponent->generateQuotationRef($company,$type);
       // Yii::$app->mycomponent->welcome();

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
