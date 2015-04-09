<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Company;

/* @var $this yii\web\View */
/* @var $model app\models\TemplateFields */
/* @var $form yii\widgets\ActiveForm */




$this->registerJsFile(Yii::getAlias('@web').'/js/template-design.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$company = ArrayHelper::map(Company::find()->all(), 'id', 'company_name');
$type= ['Quotation'=>'Quotation','Bill'=>'Bill'];
$calculation = ['Units'=>'Units','Percentage'=>'Percentage'];

?>

<div class="container">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <center class="text-muted error-msg">
            <?= Yii::$app->session->getFlash('error'); ?>
        </center>
    </div>
</div>

<form onsubmit="return false;" id="templateForm">


    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-2"><label class="form-control"> Name: </label></div>
        <div class="col-sm-6"><input type="text" class="form-control" name="template_name" ></div>
    </div>

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-2"><label class="form-control"> Company Name: </label></div>
        <div class="col-sm-6"><select class="form-control" name="company_id">
                <?php
                foreach($company as $key=>$name) { ?>
                    <option value="<?= $key; ?>"><?= $name; ?></option>
                <?php
                } ?>
            </select>
        </div>
    </div>

    <!--<div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-2"><label class="form-control"> Template Type: </label></div>
        <div class="col-sm-6"><select class="form-control" name="type">
                <?php
/*                foreach($type as $key=>$name) { */?>
                    <option value="<?/*= $key; */?>"><?/*= $name; */?></option>
                <?php
/*                } */?>
            </select></div>
    </div>-->

    <input type="hidden" name="type" value="Quotation">

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-2"><label class="form-control"> Calculation Type: </label></div>
        <div class="col-sm-6"><select class="form-control" name="calculation">
                <option selected="selected" disabled="disabled">Select one..</option>
                <?php
                foreach($calculation as $key=>$name) { ?>
                    <option value="<?= $key; ?>"><?= $name; ?></option>
                <?php
                } ?>
            </select></div>
    </div>


    <br><br>

    <button id="addSection" class="btn btn-primary" style="margin-left: 15px;">Add Section</button><br><br>

    <div class="container" id="addSectionDiv">
        <div class="template-section">
            <label class='form-control template-create-label'>Section Name:</label><input type='text' name='section_name[]' class='form-control template-input-design'>
            <button id="add" class="btn btn-primary btn-sm">Add Field</button>
            <label class='form-control template-create-label'>Fields Name:</label>
            <div id="items" class="form-group">

            </div>
        </div>
    </div>

    <center>
        <br><br>
        <button id="formSubmit" class="btn btn-primary">Create</button><br><br>
    </center>


</form>


<!--$('#items').append('<div><input type='text' name='input[]'><button class='delete'>Delete</button></div>');-->