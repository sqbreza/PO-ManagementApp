<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\TemplateFields;
use app\models\Company;
use app\models\Clients;
use dosamigos\datepicker\DatePicker;
use kartik\file\FileInput;



$this->registerJsFile(Yii::getAlias('@web').'/js/inwords.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::getAlias('@web').'/js/quotation-design.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::getAlias('@web').'/js/quotation-design-ajax.js', ['depends' => [yii\web\JqueryAsset::className()]]);

/* @var $this yii\web\View */
/* @var $searchModel app\models\QuotationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quotations';
$this->params['breadcrumbs'][] = $this->title;

$company = ArrayHelper::map(Company::find()->all(), 'id', 'company_name');
$clients = ArrayHelper::map(Clients::find()->all(), 'id', 'client_name');

?>

<div class="container">
    <center class="text-muted" style="background:lightblue; margin-bottom: 50px; width: 95%;">
        <?= Yii::$app->session->getFlash('error'); ?>
    </center>
</div>
<div class="quotation-index container">



<form class="form-horizontal" onsubmit="return false;"  enctype="multipart/form-data">


<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">Supervisor : </label></div>
        <div class="col-sm-8"><input type="text" class="form-control" name="supervisor_name"/></div>

    </div>
</div>

<!-- TEMPORARY FIELDS STARTS-->
<!--<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">Ref no : </label></div>
        <div class="col-sm-8"><input type="text" class="form-control" name="ref"/></div>

    </div>
</div>-->


    <input type="hidden" class="form-control" name="template_ref" value="<?= $id;?>" />
    <input type="hidden" class="form-control" name="user_id" value="<?= $user_id;?>" />


<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">Status : </label></div>
       <!-- <div class="col-sm-8"><input type="text" class="form-control" name="status" /></div>-->
        <div class="col-sm-8"><select class="form-control" name="status">
                <option value="Pending"> Pending </option>
                <option value="Approved"> Approved </option>
            </select></div>

    </div>
</div>

<!-- TEMPORARY FIELDS END-->

<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">Quoted By : </label></div>
        <div class="col-sm-8">
            <select class="form-control" name="company_id">
                <?php
                foreach($company as $key=>$name) { ?>
                    <option value="<?= $key; ?>"><?= $name; ?></option>
                <?php
                } ?>
            </select>

        </div>

    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">Quotation To : </label></div>
        <div class="col-sm-8">
            <select class="form-control" name="client_company_id">
                <?php
                foreach($clients as $key=>$name) { ?>
                    <option value="<?= $key; ?>"><?= $name; ?></option>
                <?php
                } ?>
            </select>
        </div>

    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">Quotation For : </label></div>
        <div class="col-sm-8"><input type="text" class="form-control" name="project_name" id="project_name"/></div>

    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">Quotation Header : </label></div>
        <div class="col-sm-8"><input type="text" class="form-control" name="project_name_header" id="project_name_header"/></div>

    </div>
</div>



<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">PO no : </label></div>
        <div class="col-sm-8"><input type="text" class="form-control" name="po_no" /></div>

    </div>
</div>


<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">Date: </label></div>
        <div class="col-sm-8">

            <?= DatePicker::widget([
                'name' => 'date',
                'value' =>date("d-m-Y"),
                'template' => '{addon}{input}',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy'
                ]
            ]);?>

        </div>

    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">Note : </label></div>
        <div class="col-sm-8"><textarea class="form-control" name="note_up"></textarea></div>

    </div>
</div>



<div class="row" style="margin-top:50px;">
    <div class="form-group">
        <div class="col-sm-3"><label  class="form-control">Field </label></div>
        <div class="col-sm-3"><label  class="form-control">Details</label></div>
        <div class="col-sm-1"><label  class="form-control">Cost*</label></div>
        <div class="col-sm-1"><label  class="form-control">Units/%</label></div>
        <div class="col-sm-2"><label  class="form-control">Total</label></div>
    </div>
</div>

<?php
foreach($section as $value){
    $sectionValue = preg_replace('/\s+/', '', $value['section']);
    $result =TemplateFields::find()->where(['template_id'=>$id,'section'=>$value['section']])->orderBy('id')->asArray()->all();
    ?>
    <div class="row">
        <h4> <?= $value['section'];?></h4>
        <div class="addSection" id="<?= $sectionValue;?>">
            <input type="hidden" name="section_name[]" value="<?= $value['section'];?>">
            <?php
            foreach($result as $val){

                ?>
                <div class="addLine">
                    <div class="form-group eachLine">

                        <div class="col-sm-3"><input type="text" name="<?= $sectionValue;?>_field_names[]" class="form-control" value="<?= $val['field_name'];?>" /></div>
                        <div class="col-sm-3"><input type="text" name="<?= $sectionValue;?>_details[]" class="form-control" /></div>
                        <div class="col-sm-1"><input type="text" name="<?= $sectionValue;?>_costs[]" class="costs form-control" /></div>
                        <div class="col-sm-1"><input type="text" name="<?= $sectionValue;?>_units[]" class="units form-control" /></div>
                        <div class="col-sm-2"><input type="text" name="<?= $sectionValue;?>_total[]" class="total form-control" /></div>
                        <div class="col-sm-2">
                            <button class="btn btn-sm btn-danger delete"> Delete </button>
                            <button class="btn btn-sm btn-success add"> Add </button>
                        </div>

                    </div>
                </div>
            <?php } ?>

            <div class="row">
                <div class="col-sm-8"></div>
                <div class="col-sm-2"><input type="text" name="<?= $sectionValue;?>_sub_total" class="<?= $sectionValue;?> form-control section_total" /></div>
            </div>


        </div>
    </div>






<?php
}

?>



<div class="row" style="margin-top: 50px;">
    <div class="form-group">
        <div class="col-sm-3"><label class="form-control">Total:</label></div>
        <div class="col-sm-5"></div>
        <div class="col-sm-2"><input type="text" name="sum_of_total" class="form-control" id="sum_total"/></div>

    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-sm-3"><label class="form-control">In words:</label></div>
        <div class="col-sm-7"><input type="text" name="amounts_in_word" class="form-control" id="amount_in_words"/></div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-sm-2">
            <label>
                <input type="hidden" name="show_section_amount" value="0">
                <input type="checkbox" id="" name="show_section_amount" value="1"> Show Sub-total in Template

            </label>
        </div>
        <div class="col-sm-3">

            <label>
                <input type="checkbox" id="check_id"> Add VAT @ 15%
            </label>

        </div>
        <div class="col-sm-3"><label class="form-control">Grand total:</label></div>
        <div class="col-sm-2"><input type="text" name="grand_total" class="form-control" id="grand_total"/></div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-sm-10">
            <input type="file" class="form-control" name="file[]" id="file" multiple="true">
        </div>
    </div>
</div>



<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">Note : </label></div>
        <div class="col-sm-8"><textarea class="form-control" name="note_down"></textarea></div>

    </div>
</div>


<div class="row">
    <div class="form-group">
        <div class="col-sm-5"></div>
        <div class="col-sm-2">
            <button class=" btn btn-success" id="save"> Save </button>
        </div>
    </div>
</div>




</form>



<blockquote class="text-muted" style="background: #f5f5f5; font-size: 12px;">
    * Cost per day
</blockquote>

</div>
