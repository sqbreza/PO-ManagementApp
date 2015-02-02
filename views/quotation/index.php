<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QuotationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quotations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quotation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--<p>
        <?/*= Html::a('Create Quotation', ['create'], ['class' => 'btn btn-success']) */?>
    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'ref',
            'project_name',
            'client_company_id',
            'amount',
            // 'vat',
            // 'total',
            // 'date',
             'po_no',
             'status',
            // 'client_company_id',
            // 'user_id',
            // 'supervisor_name',

            [
                'attribute' => 'Edit/view',
                'format' => 'raw',
                'value' => function ($model, $key, $index) {
                    return Html::a('Edit/view', ['quotation/view-quotation', 'id' => $model->id]);
                },
            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
