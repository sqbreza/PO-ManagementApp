<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Clients;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QuotationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quotations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quotation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Quotation', ['template/choose-template'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'ref',
            'company.company_name',
            'project_name',
            //'client_company_id',
            'clients.client_name',
            'amount',
            // 'vat',
            // 'total',
            // 'date',
             'po_no',
             'status',
            // 'client_company_id',
              'user.username',
            // 'supervisor_name',



            [
                'attribute' => '',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a('Edit/view', ['quotation/view-quotation', 'id' => $model->id]);
                },
            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
