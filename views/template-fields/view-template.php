<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Company;
use app\models\TemplateFields;
use app\models\Template;

/* @var $this yii\web\View */
/* @var $model app\models\TemplateFields */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(Yii::getAlias('@web').'/js/template-design.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$company = ArrayHelper::map(Company::find()->all(), 'id', 'company_name');
$type= ['Quotation'=>'Quotation','Bill'=>'Bill'];

$template =Template::find()->where('id=:id',['id'=>$id])->one();
$company_name = Company::find()->where('id=:id',['id'=>$template->company_id])->one()->company_name;



?>

<form onsubmit="return false;" id="templateForm">


    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-2"><label class="form-control"> Name: </label></div>
        <div class="col-sm-6"><input type="text" class="form-control" name="template_name" value="<?=$template->name;?>"></div>
    </div>

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-2"><label class="form-control"> Company Name: </label></div>
        <div class="col-sm-3"><label class="form-control"> <?=$company_name;?> </label></div>
        <div class="col-sm-3"><select class="form-control" name="company_id">
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
        <div class="col-sm-3"><label class="form-control"> <?=$template->type;?> </label></div>
        <div class="col-sm-3"><select class="form-control" name="type">
                <?php
                foreach($type as $key=>$name) { ?>
                    <option value="<?= $key; ?>"><?= $name; ?></option>
                <?php
                } ?>
            </select></div>
    </div><br><br>

    <!--<button id="addSection" class="btn btn-primary" style="margin-left: 15px;">Add Section</button><br><br>-->

    <div class="container" id="addSectionDiv">
        <?php foreach($section as $key1=>$value){
            $result =TemplateFields::find()->where(['template_id'=>$id,'section'=>$value['section']])->orderBy('id')->asArray()->all();
            ?>

        <div class="template-section">

            <label class='form-control template-create-label'>Section Name:</label><input type='text' name='section_name[]' value="<?=$value['section'];?>" class='form-control template-input-design'>
            <button id="add" class="btn btn-primary btn-sm">Add Field</button>
            <label class='form-control template-create-label'>Fields Name:</label>
            <?php foreach($result as $key=>$value){?>
            <div><input type='text' name='section<?= $key1;?>_field_name[]' value="<?=$value['field_name']?>" class='form-control template-input-design'><button class='delete btn-sm btn-danger'>Delete</button></div>
            <?php } ?>
            <div id="items" class="form-group">

            </div>
        </div>
            <br>
        <?php } ?>
    </div>

    <input type="hidden" value="<?=$id;?>" name="id">



    <center>
        <br><br>
        <button id="formUpdate" class="btn btn-primary">Submit</button><br><br>
    </center>


</form>


<!--$('#items').append('<div><input type='text' name='input[]'><button class='delete'>Delete</button></div>');-->