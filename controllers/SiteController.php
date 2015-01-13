<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use kartik\mpdf\Pdf;

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



    public function actionQuotationIce9() {

        $header = "<div><div style='float: left; width: 200px; font-size: 32px;' class='text-muted'>QUOTATION</div><div style='float: left;'><img src='../web/images/ice9.png' width='60' style='float:right;'/></div></div>";
        $footer = "<div style='float:left; width: 100%; text-align: center;'> ice9 Footer | ice9 Footer | ice9 Footer | ice9 Footer | ice9 Footer | ice9 Footer | ice9 Footer | ice9 Footer | ice9 Footer | ice9 Footer </div>";
        $watermark = "WATERMARK";
        $htmlContent = $this->renderPartial('_reportView');
        $pdf = Yii::$app->pdf;
        $mpdf = $pdf->api; // fetches mpdf api
        $mpdf->SetHTMLHeader ($header);
        $mpdf->SetHTMLFooter ($footer);
        $mpdf->SetWatermarkText ($watermark);
        //$mpdf->showWatermarkText = true;
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
