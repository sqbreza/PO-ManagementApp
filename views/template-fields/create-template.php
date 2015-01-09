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

?>

<form onsubmit="return false;" id="templateForm">


    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-2"><label class="form-control"> Name: </label></div>
        <div class="col-sm-6"><input type="text" class="form-control" name="template_name"></div>
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

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-2"><label class="form-control"> Template Type: </label></div>
        <div class="col-sm-6"><select class="form-control" name="type">
                <?php
                foreach($type as $key=>$name) { ?>
                    <option value="<?= $key; ?>"><?= $name; ?></option>
                <?php
                } ?>
            </select></div>
    </div><br><br>

    <button id="addSection" class="btn btn-primary">Add Section</button><br><br>

    <div class="container" id="addSectionDiv">
        <div style="border:1px solid grey; border-radius:5px;">
        <label class='form-control'>Section Name:</label><input type='text' name='section_name[]' class='form-control template-input-design'>
        <button id="add" class="btn btn-primary btn-sm">Add Field</button>
        <label class='form-control'>Fields Name:</label>
        <div id="items" class="form-group">

        </div>
        </div>
    </div>

    <center>
        <br><br>
        <button id="formSubmit" class="btn btn-primary">Submit</button><br><br>
    </center>


</form>


<!--$('#items').append('<div><input type='text' name='input[]'><button class='delete'>Delete</button></div>');-->