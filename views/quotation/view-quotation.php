<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\TemplateFields;
use app\models\QuationRef;
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

$section = QuationRef::find()->where(['quotation_ref'=>$model->ref])->groupBy('section')->orderBy('id')->asArray()->all();


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
        <div class="col-sm-8"><input type="text" class="form-control" name="supervisor_name" value="<?=$model->supervisor_name?>"/></div>

    </div>
</div>

<!-- TEMPORARY FIELDS STARTS-->
<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">Ref no : </label></div>
        <div class="col-sm-8"><input type="text" class="form-control" name="ref" value="<?=$model->ref?>" /></div>

    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">User ID : </label></div>
        <div class="col-sm-8"><input type="text" class="form-control" name="user_id" value="<?=$model->user_id?>"/></div>

    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">Template ref ID : </label></div>
        <div class="col-sm-8"><input type="text" class="form-control" name="template_ref" /></div>

    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">Status : </label></div>
        <div class="col-sm-8"><input type="text" class="form-control" name="status" /></div>

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
        <div class="col-sm-8"><input type="text" class="form-control" name="project_name" value="<?=$model->project_name?>"/></div>

    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">Quotation Header : </label></div>
        <div class="col-sm-8"><input type="text" class="form-control" name="project_name_full"/></div>

    </div>
</div>



<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">PO no : </label></div>
        <div class="col-sm-8"><input type="text" class="form-control" name="po_no" value="<?=$model->po_no?>" /></div>

    </div>
</div>


<div class="row">
    <div class="form-group">
        <div class="col-sm-2"><label  class="form-control">Date: </label></div>
        <div class="col-sm-8">

            <?= DatePicker::widget([
                'name' => 'date',
                'value' =>$model->date,
                'template' => '{addon}{input}',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy'
                ]
            ]);?>

        </div>

    </div>
</div>


<div class="row" style="margin-top:50px;">
    <div class="form-group">
        <div class="col-sm-3"><label  class="form-control">Field </label></div>
        <div class="col-sm-3"><label  class="form-control">Details</label></div>
        <div class="col-sm-1"><label  class="form-control">Cost*</label></div>
        <div class="col-sm-1"><label  class="form-control">Units</label></div>
        <div class="col-sm-2"><label  class="form-control">Total</label></div>
    </div>
</div>

<?php
foreach($section as $value){
    $result =QuationRef::find()->where(['quotation_ref'=>'RF2313','section'=>$value['section']])->orderBy('id')->asArray()->all();
    ?>
    <div class="row">
        <h4> <?= $value['section'];?></h4>
        <div class="addSection" id="<?= $value['section'];?>">
            <input type="hidden" name="section_name[]" value="<?= $value['section'];?>">
            <?php
            foreach($result as $val){

                ?>
                <div class="addLine">
                    <div class="form-group eachLine">

                        <div class="col-sm-3"><input type="text" name="<?= $value['section'];?>_field_names[]" class="form-control" value="<?= $val['field_name'];?>" /></div>
                        <div class="col-sm-3"><input type="text" name="<?= $value['section'];?>_details[]" class="form-control" value="<?= $val['details'];?>"/></div>
                        <div class="col-sm-1"><input type="text" name="<?= $value['section'];?>_costs[]" class="costs form-control" value="<?= $val['cost_day'];?>"/></div>
                        <div class="col-sm-1"><input type="text" name="<?= $value['section'];?>_units[]" class="units form-control" value="<?= $val['units'];?>"/></div>
                        <div class="col-sm-2"><input type="text" name="<?= $value['section'];?>_total[]" class="total form-control" value="<?= $val['total'];?>"/></div>
                        <div class="col-sm-2">
                            <button class="btn btn-sm btn-danger delete"> Delete </button>
                            <button class="btn btn-sm btn-success add"> Add </button>
                        </div>

                    </div>
                </div>
            <?php } ?>

            <div class="row">
                <div class="col-sm-8"></div>
                <div class="col-sm-2"><input type="text" name="<?= $value['section'];?>_sub_total" class="<?= $value['section'];?> form-control section_total" /></div>
            </div>


        </div>
    </div>






<?php
}

?>



<div class="row" style="margin-top: 50px;">
    <div class="col-sm-5"></div>
    <div class="col-sm-3"><label class="form-control">Total:</label></div>
    <div class="col-sm-2"><input type="text" name="sum_of_total" class="form-control" id="sum_total"/></div>
</div>

<div class="row">
    <div class="col-sm-5"></div>
    <div class="col-sm-3"><label class="form-control">In words:</label></div>
    <div class="col-sm-4"><input type="text" name="amounts_in_word" class="form-control" id="amount_in_words"/></div>
</div>

<div class="row">
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

<div class="row">
    <input type="file" class="form-control" name="file[]" id="file" multiple="true">
</div>



<div class="row" style="margin-top: 30px;">
    <label class="form-control">Note : </label>
    <textarea name="note" class="form-control"><?= $model->note;?></textarea>
</div>


<div class="row" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="col-sm-5"></div>
    <div class="col-sm-2"><button class="btn btn-success btn-lg" id="save"> Save </button></div>
</div>




</form>



<blockquote class="text-muted" style="background: #f5f5f5; font-size: 12px;">
    * Cost per day
</blockquote>

</div>
