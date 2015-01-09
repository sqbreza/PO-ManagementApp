<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TemplateFieldsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Template Fields');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-fields-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <!-- <p>
        <?/*= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Template Fields',
]), ['create'], ['class' => 'btn btn-success']) */?>
    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      /*  'filterModel' => $searchModel,*/
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'section',
            'field_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
