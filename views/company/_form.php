<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'established_date')->textInput() ?>

    <?= $form->field($model, 'total_employee')->textInput() ?>

    <?= $form->field($model, 'contact_no')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'company_vat')->textInput() ?>

    <?= $form->field($model, 'quotation_header_image')->fileInput(['class'=>'form-control']) ?>

    <?= $form->field($model, 'quotation_table_header_color')->input('color',['maxlength' => 255]) ?>

    <?= $form->field($model, 'quotation_table_sub_header_color')->input('color',['maxlength' => 255]) ?>

    <?= $form->field($model, 'quotation_watermark_image')->fileInput(['class'=>'form-control']) ?>

    <?= $form->field($model, 'bill_header_image')->fileInput(['class'=>'form-control']) ?>

    <?= $form->field($model, 'bill_table_header_color')->input('color',['maxlength' => 255]) ?>

    <?= $form->field($model, 'bill_table_sub_header_color')->input('color',['maxlength' => 255]) ?>

    <?= $form->field($model, 'bill_watermark_image')->fileInput(['class'=>'form-control']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
