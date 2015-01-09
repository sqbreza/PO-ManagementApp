<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TemplateFields */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="template-fields-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'template_id')->textInput() ?>

    <?= $form->field($model, 'section')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'field_name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'template_type')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
