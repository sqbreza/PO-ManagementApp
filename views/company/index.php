<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Companies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Company',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'company_name',
            'address',
            'established_date',
            'total_employee',
            // 'contact_no',
            // 'email:email',
            // 'website',
            // 'company_vat',
            // 'quotation_header_image',
            // 'quotation_table_header_color',
            // 'quotation_table_sub_header_color',
            // 'quotation_watermark_image',
            // 'bill_header_image',
            // 'bill_table_header_color',
            // 'bill_table_sub_header_color',
            // 'bill_watermark_image',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
