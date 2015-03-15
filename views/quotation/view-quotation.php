<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\TemplateFields;
use app\models\Company;
use app\models\Clients;
use app\models\FileArchive;
use dosamigos\datepicker\DatePicker;
use kartik\file\FileInput;
use app\models\QuotationRef;
use app\models\Quotation;
use app\models\Template;


$this->registerCssFile(Yii::getAlias('@web').'/jQueryTE/jquery-te-1.4.0.css', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::getAlias('@web').'/jQueryTE/jquery-te-1.4.0.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);


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

$section = QuotationRef::find()->where(['ref'=>$model->ref])->groupBy('section')->orderBy('id')->asArray()->all();

?>

<div class="container">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <center class="text-muted error-msg">
            <?= Yii::$app->session->getFlash('error'); ?>
        </center>
    </div>
</div>

<div class="quotation-index container">



<form class="form-horizontal" onsubmit="return false;"  enctype="multipart/form-data">


<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">Supervisor : </label></div>
        <div class="col-sm-8"><input  type="text" class="form-control" name="supervisor_name" value="<?= $model->supervisor_name;?>"/></div>

    </div>
</div>

<!-- TEMPORARY FIELDS STARTS-->
<!--<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">Ref no : </label></div>
        <div class="col-sm-8"><input  type="text" class="form-control" name="ref"/></div>

    </div>
</div>-->


<input  type="hidden" class="form-control" name="template_ref" value="<?= $model->template_ref;?>" />
<input  type="hidden" class="form-control" name="user_id" value="<?= $model->user_id;?>" />
<input  type="hidden" class="form-control" name="model_id" value="<?= $model->id;?>" />
<input  type="hidden" class="form-control" name="ref" value="<?= $model->ref;?>" />

<?php
$green = "style='background:limegreen'";
$red = "style='background:orange'";
?>

<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">Status : </label></div>
        <!--<div class="col-sm-8"><input  type="text" class="form-control" name="status" value ="<?/*= $model->status;*/?>"/></div>-->
        <div class="col-sm-2"><label class="form-control text-center" <?=($model->status=='Approved')?$green:$red?>> <?= $model->status;?></label></div>
        <div class="col-sm-6"><select class="form-control" name="status">
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
        <div class="col-sm-8"><input  type="text" class="form-control" name="project_name" id="project_name" value="<?= $model->project_name;?>"/></div>

    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">Quotation Header : </label></div>
        <div class="col-sm-8"><input  type="text" class="form-control" name="project_name_header" id="project_name_header" value="<?= $model->project_name_header;?>"/></div>

    </div>
</div>



<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">PO no : </label></div>
        <div class="col-sm-8"><input type="text" class="form-control" name="po_no" value="<?= $model->po_no;?>"/></div>

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
        <div class="col-sm-8"><textarea   name="note_up"><?= $model->note_up;?></textarea></div>
    </div>
</div>






<div class="row" style="margin-top:50px;">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">Field </label></div>
        <div class="col-sm-3"><label  class="form-control">Details</label></div>
        <div class="col-sm-2"><label  class="form-control">Cost</label></div>
        <?php
        $calculation = Quotation::find()->select('calculation')->where('id = :id',['id'=>$model->id])->one()->calculation;

        $service_charge = unserialize(Quotation::find()->select('service_charge')->where('id = :id',['id'=>$model->id])->one()->service_charge);


        if($calculation == 'Units'){ ?>
            <div class="col-sm-1"><label  class="form-control">Units</label></div>
        <?php }else{ ?>
            <div class="col-sm-1"><label  class="form-control">%</label></div>
        <?php }?>
        <input  type="hidden" id="calculation" value="<?=$calculation?>">
        <div class="col-sm-2"><label  class="form-control">Total</label></div>
    </div>
    <input  type="hidden" class="form-control" name="calculation" value="<?= $calculation?>" />
</div>

    <?php

        $service_key = 0;
        foreach($section as $value){
            $sectionValue = preg_replace('/\s+/', '', $value['section']);
            $result =QuotationRef::find()->where(['ref'=>$model->ref,'section'=>$value['section']])->orderBy('id')->asArray()->all();
    ?>
    <div class="row">
        <h4> <?= $value['section'];?></h4>
        <div class="addSection" id="<?=$sectionValue;?>">
            <input  type="hidden" name="section_name[]" value="<?= $value['section'];?>">
            <?php
            foreach($result as $val){

                ?>
                <div class="addLine">
                    <div class="form-group eachLine">
                        <div class="col-sm-2"><input  type="text" name="<?= $sectionValue;?>_field_names[]" class="form-control" value="<?= $val['field_name'];?>" /></div>
                        <div class="col-sm-3"><input  type="text" name="<?= $sectionValue;?>_details[]" class="form-control" value="<?= $val['details'];?>" /></div>
                        <div class="col-sm-2"><input  type="text" name="<?= $sectionValue;?>_costs[]" class="costs form-control" value="<?= $val['cost_day'];?>" /></div>
                        <div class="col-sm-1"><input  type="text" name="<?= $sectionValue;?>_units[]" class="units form-control" value="<?= $val['units'];?>"/></div>
                        <div class="col-sm-2"><input  type="text" name="<?= $sectionValue;?>_total[]" class="total form-control" value="<?= $val['total'];?>"/></div>
                        <div class="col-sm-2">
                            <button class="btn btn-sm btn-danger delete"> Delete </button>
                            <button class="btn btn-sm btn-success add"> Add </button>
                        </div>

                    </div>

                </div>
            <?php } ?>

            <div class="row">
                <div class="col-sm-8"></div>
                <div class="col-sm-2"><input readonly  type="text" id="<?= $sectionValue;?>_sub_total_no_sc" name="<?= $sectionValue;?>_sub_total_no_sc" class="<?= $sectionValue;?> form-control" /></div>
            </div>
            <div class="row">
            <div class="col-sm-3">
                <label>
                    <input  <?php if($service_charge[$service_key]!=0) echo 'checked';?> type="checkbox" class="service_charge" id="check_id_<?=$sectionValue?>"> Add Service Charge @
                    <input size="1" maxlength="3" type="text" value="<?= $service_charge[$service_key];?>" name="service_charge[]" class="service_charge" id="service_charge_<?=$sectionValue;?>"> %
                </label>
            </div>
                <div class="col-sm-5"></div>
                <div class="col-sm-2"><input readonly  type="text" id="<?= $sectionValue;?>_sub_total_amount_sc" class="form-control" /></div>



            </div>
            <div class="row">
                <div class="col-sm-8"></div>
                <div class="col-sm-2"><input readonly  type="text" id="<?= $sectionValue;?>_sub_total" name="<?= $sectionValue;?>_sub_total" class="<?= $sectionValue;?> form-control section_total" /></div>
            </div>




        </div>
    </div>






<?php
            $service_key++;
}

?>



<div class="row" style="margin-top: 50px;">
    <div class="form-group">
        <div class="col-sm-3"><label class="form-control">Total:</label></div>
        <div class="col-sm-5"></div>
        <div class="col-sm-2"><input readonly  type="text" name="sum_of_total" class="form-control" id="sum_total"/></div>

    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-sm-3"><label class="form-control">In words:</label></div>
        <div class="col-sm-7"><input  type="text" name="amounts_in_word" class="form-control" id="amount_in_words"/></div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-sm-2">
            <label>
                <input  type="hidden" name="show_section_amount" value="1">
                <input  type="checkbox" id="" name="show_section_amount" value="0"> Hide sub-total in Template

            </label>
        </div>
        <div class="col-sm-3">

            <label>
                <input  type="hidden"  name="company_vat_checked" value="0">
                <input  type="checkbox" id="check_id" name="company_vat_checked" value="1"> Add VAT @
                <input readonly  size="1" maxlength="2" type="text" value="15" name="company_vat" id="company_vat" style="background: #eee;"> %

            </label>

        </div>
        <div class="col-sm-3"><label class="form-control">Grand total:</label></div>
        <div class="col-sm-2"><input  type="text" name="grand_total" class="form-control" id="grand_total" value="<?= $model->amount;?>"/></div>
    </div>
</div>


<div class="row">
    <div class="form-group">
        <div class="col-sm-10">
            <input  type="file" class="form-control" name="file[]" id="file" multiple="true">
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-sm-10" id="arc_file_div">
            <?php
            $files = FileArchive::find()->where('ref=:ref AND type=:type',['ref'=>$model->ref,'type'=>'Quotation'])->all();

            foreach($files as $key=>$file){

                ?>
                <div class="table-bordered col-sm-12 arc_file_table">
                    <div class="col-sm-6 text-left"><a target="_blank" class="btn btn-xs" href="<?= Yii::getAlias('@web')?>/uploads/<?= $file->file_name?>"> Attachment <?= $key+1;?> </a></div>
                    <div class="col-sm-6 text-right"><a class="btn btn-danger btn-xs" onclick="deleteFile('<?= $file->file_name;?>','<?=$model->ref;?>');">Delete</a></div>

                </div>

            <?php
            }
            ?>

        </div>
    </div>
</div>



<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">Note : </label></div>
        <div class="col-sm-8"><textarea class="form-control" name="note_down"><?=$model->note_down;?></textarea></div>

    </div>
</div>


<div class="row">
    <div class="form-group">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <button class="col-sm-3 btn btn-success" id="update" style="margin-left: 2px;"> Update </button>
            <a href="<?=Yii::getAlias('@web')?>/site/qpdf/<?=$model->id?>" target="_blank" class="btn btn-danger col-sm-3" style="margin-left: 2px;">view PDF</a>
            <button class=" btn btn-primary col-sm-3" id="save" style="margin-left: 2px;"> Save as New </button>
        </div>

    </div>
</div>




</form>



</div>
