<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Templates');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Template', ['template-fields/create-template'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'company.company_name',
            'type',
            [
                'attribute' => '',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a('Edit/view', ['template-fields/view-template', 'id' => $model->id]);
                },
            ],
            [
                'attribute' => '',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a('Delete', ['template-fields/delete-template', 'id' => $model->id]);
                },
            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
