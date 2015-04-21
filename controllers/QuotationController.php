<?php

namespace app\controllers;

use app\models\QuotationRef;
use app\models\RefGenerator;
use app\models\Template;
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

     

        $isSave = true;
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();

        $user_id = $_POST['user_id'];
        $status = $_POST['status'];
        $template_ref = $_POST['template_ref'];
        $company_id = $_POST['company_id'];
        $date = $_POST['date'];
        $show_section_amount = $_POST['show_section_amount'];
        $results = $_POST['section_name'];
        $calculation = $_POST['calculation'];

        $vat_checked = $_POST['company_vat_checked'];
        if($vat_checked == 1){
            $vat = $_POST['company_vat'];
        }else{
            $vat = 0;
        }

        $service_charge =serialize($_POST['service_charge']);



        if(!empty($_POST['supervisor_name'])){
            $supervisor_name = $_POST['supervisor_name'];
        }else{
            Yii::$app->getSession()->setFlash('error', 'Supervisor name must not be empty!');
            return $this->redirect('create-quotation?id='.$template_ref);
        }

        if(!empty($_POST['project_name'])){
            $project_name = $_POST['project_name'];
        }else{
            Yii::$app->getSession()->setFlash('error', 'Project name must not be empty!');
            return $this->redirect('create-quotation?id='.$template_ref);
        }
        if(!empty($_POST['project_name_header'])){
            $project_name_header = $_POST['project_name_header'];
        }else{
            Yii::$app->getSession()->setFlash('error', 'Project name header must not be empty!');
            return $this->redirect('create-quotation?id='.$template_ref);
        }

        if(!empty($_POST['client_company_id'])){
            $client_company_id = $_POST['client_company_id'];
        }else{
            Yii::$app->getSession()->setFlash('error', 'Client name must not be empty!');
            return $this->redirect('create-quotation?id='.$template_ref);
        }


        if(!empty($_POST['grand_total'])){
            $grand_total = $_POST['grand_total'];
        }else{
            Yii::$app->getSession()->setFlash('error', 'Grand Total must not be empty!');
            return $this->redirect('create-quotation?id='.$template_ref);
        }

        if(!empty($_POST['amounts_in_word'])){
            $amounts_in_word = $_POST['amounts_in_word'];
        }else{
            Yii::$app->getSession()->setFlash('error', 'Amount in words must not be empty!');
            return $this->redirect('view-quotation?id='.$template_ref);
        }


        if(!empty($_POST['note_up'])){
            $note_up = $_POST['note_up'];
        }else{
            $note_up = '';
        }
        if(!empty($_POST['note_down'])){
            $note_down = $_POST['note_down'];
        }else{
            $note_down = '';
        }

        $ref = Yii::$app->mycomponent->generateQuotationRef('Ice9','Quotation');

        if(!empty($_POST['po_no'])){
            $po_no = $_POST['po_no'];
        }else{
            $po_no = $ref;
        }



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

            foreach($results as $key=>$value){

                $actual_section_name =  $value;
                //$section_name =  preg_replace('/\s+/', '', $value);
                $section_name = $key;
                $field_names = $_POST[$section_name."_field_names"];
                $details = $_POST[$section_name."_details"];
                $costs = $_POST[$section_name."_costs"];
                $units = $_POST[$section_name."_units"];
                $total = $_POST[$section_name."_total"];

                foreach($field_names as $key=>$value){

                    $model = new QuotationRef();

                    $model->ref = $ref;
                    $model->template_ref = $template_ref;
                    $model->section = $actual_section_name;
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
            $model->date = Yii::$app->formatter->asDatetime($date, "php:Y-m-d");
            $model->status = $status;
            $model->user_id = $user_id;
            $model->supervisor_name = $supervisor_name;
            $model->show_section_amount = $show_section_amount;
            $model->note_up = $note_up;
            $model->note_down = $note_down;
            $model->template_ref = $template_ref;
            $model->calculation = $calculation;
            $model->vat = $vat;
            $model->service_charge = $service_charge;
            $model->amount_words = $amounts_in_word;

            $model->created_time = date('Y-m-d H:i:s');

            if(!$model->save()) {
                $isSave = false;
            }else{
                $mId =$model->id;


            if($isSave) {
                $transaction->commit();
                Yii::$app->getSession()->setFlash('error', 'Successfully Added !');
                echo json_encode(['id'=>$mId]);
                //return $this->redirect('view-quotation?id='.$mId);
                //return $this->redirect('create-quotation?id='.$template_ref);
            }else{
                $model = new RefGenerator();
                $model->find()->orderBy(['id'=>SORT_DESC])->one();
                $model->deleteAll(['id=:id','id'=>$model->id]);
                Yii::$app->getSession()->setFlash('error', 'An error occurred during submit process, Please submit again');
                return $this->redirect('create-quotation');
                }
            }

        }catch (Exception $e){
            $transaction->rollback();
        }


    }


    public function actionFormUpdate()
    {



        $isSave = true;

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();

        $model_id = $_POST['model_id'];
        $calculation = $_POST['calculation'];
        $user_id = $_POST['user_id'];
        $status = $_POST['status'];
        $template_ref = $_POST['template_ref'];
        $company_id = $_POST['company_id'];
        $date = $_POST['date'];
        $show_section_amount = $_POST['show_section_amount'];
        $results = $_POST['section_name'];
        $ref = $_POST['ref'];
        $vat_checked = $_POST['company_vat_checked'];
        if($vat_checked == 1){
            $vat = $_POST['company_vat'];
        }else{
            $vat = 0;
        }

        if(!empty($_POST['client_company_id'])){
            $client_company_id = $_POST['client_company_id'];
        }else{
            $client_company_id = '';
        }

        $service_charge =serialize($_POST['service_charge']);
        if(!empty($_POST['supervisor_name'])){
            $supervisor_name = $_POST['supervisor_name'];
        }else{
            Yii::$app->getSession()->setFlash('error', 'Supervisor name must not be empty!');
            return $this->redirect('view-quotation?id='.$model_id);
        }

        if(!empty($_POST['project_name'])){
            $project_name = $_POST['project_name'];
        }else{
            Yii::$app->getSession()->setFlash('error', 'Project name must not be empty!');
            return $this->redirect('view-quotation?id='.$model_id);
        }
        if(!empty($_POST['project_name_header'])){
            $project_name_header = $_POST['project_name_header'];
        }else{
            Yii::$app->getSession()->setFlash('error', 'Project name header must not be empty!');
            return $this->redirect('view-quotation?id='.$model_id);
        }
        if(!empty($_POST['po_no'])){
            $po_no = $_POST['po_no'];
        }else{
            $po_no = '';
        }

        if(!empty($_POST['grand_total'])){
            $grand_total = $_POST['grand_total'];
        }else{
            Yii::$app->getSession()->setFlash('error', 'Grand Total must not be empty!');
            return $this->redirect('view-quotation?id='.$model_id);
        }

        if(!empty($_POST['amounts_in_word'])){
            $amounts_in_word = $_POST['amounts_in_word'];
        }else{
            Yii::$app->getSession()->setFlash('error', 'Amount in words must not be empty!');
            return $this->redirect('view-quotation?id='.$model_id);
        }


        if(!empty($_POST['note_up'])){
            $note_up = $_POST['note_up'];
        }else{
            $note_up = '';
        }
        if(!empty($_POST['note_down'])){
            $note_down = $_POST['note_down'];
        }else{
            $note_down = '';
        }




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

            if(!QuotationRef::deleteAll('ref = :ref', ['ref' => $ref])){
                $isSave = false;
            }

            foreach($results as $key=>$value){
                $actual_section_name =  $value;
                //$section_name =  preg_replace('/\s+/', '', $value);
                $section_name =  $key;
                $field_names = $_POST[$section_name."_field_names"];
                $details = $_POST[$section_name."_details"];
                $costs = $_POST[$section_name."_costs"];
                $units = $_POST[$section_name."_units"];
                $total = $_POST[$section_name."_total"];

                foreach($field_names as $key=>$value){

                    $model = new QuotationRef();

                    $model->ref = $ref;
                    $model->template_ref = $template_ref;
                    $model->section = $actual_section_name;
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

            if(!empty($client_company_id)){
                $model->client_company_id = $client_company_id;
            }
            $model->amount = $grand_total;
            $model->po_no = $po_no;
            $model->date = Yii::$app->formatter->asDatetime($date, "php:Y-m-d");;
            $model->status = $status;
            $model->user_id = $user_id;
            $model->supervisor_name = $supervisor_name;
            $model->show_section_amount = $show_section_amount;
            $model->note_up = $note_up;
            $model->note_down = $note_down;
            $model->template_ref = $template_ref;
            $model->calculation = $calculation;
            $model->vat = $vat;
            $model->service_charge = $service_charge;
            $model->amount_words = $amounts_in_word;

            $model->created_time = date('Y-m-d H:i:s');



            if(!$model->save()) {
                $isSave = false;
            }


            if($isSave) {

                $transaction->commit();
                Yii::$app->getSession()->setFlash('error', 'Successfully Updated !');
                echo json_encode(['id'=>$model_id]);
                //return $this->redirect('view-quotation?id='.$model_id);
            }else{

                Yii::$app->getSession()->setFlash('error', 'An error occurred during submit process, fill up all the fields correctly and submit again');
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

    public function actionDeleteQuotation()
    {

        if (Yii::$app->user->can("admin")) {
            $isSave = false;
            $connection = \Yii::$app->db;
            $transaction = $connection->beginTransaction();
            $id = $_POST['id'];
            $ref = $_POST['ref'];




            try{
               if( QuotationRef::deleteAll('ref = :ref',['ref'=>$ref])){
                   if(Quotation::deleteAll('id = :id',['id'=>$id])){
                       if(FileArchive::deleteAll('ref=:ref',['ref'=>$ref])){
                           $files = FileArchive::find()->select(['file_name'])->where('ref = :ref',['ref'=>$ref])->asArray()->all();

                           foreach ($files as $val){
                               $file_name = $val['file_name'];
                               if (!unlink('uploads/'.$file_name)) {
                                   return false;
                               }
                           }

                           $isSave = true;
                       }else{
                           $isSave = true;
                       }
                   }

               }
                if($isSave) {

                    $transaction->commit();
                    return $this->redirect('index');
                }


            }catch (Exception $e){
                $transaction->rollback();
            }






        }else{
            echo 'You are not allowed to perform this action.';
        }



        /*if (!unlink('uploads/'.$file_name)) {
            return false;
        }else{
            FileArchive::deleteAll('file_name=:file_name',['file_name'=>$file_name]);
            $files = FileArchive::find()->where('ref=:ref',['ref'=>$ref])->asArray()->all();
            echo json_encode($files);
        }*/


    }

    public function actionCreateQuotation($id)
    {
       // $models = TemplateFields::findAll(['template_id'=>12]);
        $template = Template::find()->where(['id'=>$id])->one();

        if(!$template){
            return $this->redirect('index');
        }

        $section = TemplateFields::find()->where(['template_id'=>$id])->groupBy('section')->orderBy('id')->asArray()->all();
        $model = TemplateFields::find()->where(['template_id'=>$id])->orderBy('id')->asArray()->all();


        return $this->render('create-quotation', [
            'section' => $section,
            'model' => $model,
            'template' => $template,
            'id'=>$id,
            'user_id'=>Yii::$app->user->getId(),
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
