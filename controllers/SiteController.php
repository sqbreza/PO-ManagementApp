<?php

namespace app\controllers;

use app\models\Clients;
use app\models\Company;
use app\models\Template;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use kartik\mpdf\Pdf;
use app\models\Quotation;
use app\models\QuotationRef;

use yii\web\ForbiddenHttpException;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }



    public function actionQpdf($id) {

        if (!empty(Yii::$app->user) && !Yii::$app->user->can("user")) {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }

        $quotation = Quotation::find()->where('id = :id',['id'=>$id,])->one();
        $template = Template::find()->where(['id'=>$quotation->template_ref])->one();
        $company = Company::find()->where(['id'=>$quotation->company_id])->one();
        $client = Clients::find()->where(['id'=>$quotation->client_company_id])->one();
        //$quotation_ref = QuotationRef::find()->where('ref = :ref',['ref'=>$quotation->ref,])->all();
        $section = QuotationRef::find()->where(['ref'=>$quotation->ref])->groupBy('section')->orderBy('id')->asArray()->all();

        $baseUrl = Yii::getAlias('@web').'/uploads/q/';
        $header = "<img src='".$baseUrl.$company->quotation_header_image."'>";
        $watermark = $baseUrl.$company->quotation_watermark_image;

        $footer = "<div style='float:left; width: 100%; text-align: center;'> <strong> Contact No.-".$company->contact_no." | ".$company->address." </strong> <br> ".$company->email." | ".$company->website."</div>";
        $htmlContent = $this->renderPartial('_reportView',[
            'quotation'=>$quotation,
            'template'=>$template,
            'company'=>$company,
            'client'=>$client,
            'section'=>$section
        ]);
         $pdf = Yii::$app->pdf;
        $mpdf = $pdf->api; // fetches mpdf api
        $mpdf->SetHTMLHeader($header);
        $mpdf->SetHTMLFooter ($footer);
        $mpdf->SetWatermarkImage ($watermark,0.1, '',array(0,0));
        $mpdf->showWatermarkImage = true;
        $pdf->content = $htmlContent;
        return $pdf->render();
    }


    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
