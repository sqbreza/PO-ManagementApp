<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CompanySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'company_name') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'established_date') ?>

    <?= $form->field($model, 'total_employee') ?>

    <?php // echo $form->field($model, 'contact_no') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'website') ?>

    <?php // echo $form->field($model, 'company_vat') ?>

    <?php // echo $form->field($model, 'quotation_header_image') ?>

    <?php // echo $form->field($model, 'quotation_table_header_color') ?>

    <?php // echo $form->field($model, 'quotation_table_sub_header_color') ?>

    <?php // echo $form->field($model, 'quotation_watermark_image') ?>

    <?php // echo $form->field($model, 'bill_header_image') ?>

    <?php // echo $form->field($model, 'bill_table_header_color') ?>

    <?php // echo $form->field($model, 'bill_table_sub_header_color') ?>

    <?php // echo $form->field($model, 'bill_watermark_image') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
