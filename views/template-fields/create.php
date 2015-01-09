<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TemplateFields */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Template Fields',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Template Fields'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-fields-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
