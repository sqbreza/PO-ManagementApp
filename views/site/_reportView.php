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

?>
<!-- <table style=" width:100%;">

        <?php /*foreach($company as $key=>$value): */?>
            <tr>
                <td style="border: 1px solid black;"><?/*= $value->id; */?></td>
                <td style="border: 1px solid black;"> <?/*= $value->po_no; */?></td>
                <td style="border: 1px solid black;"> <?/*= $value->status; */?></td>
                <td style="border: 1px solid black;"> <?/*= $value->supervisor_name; */?></td>
            </tr>
        <?php /*endforeach; */?>
    </table>

-->

<div style="width: 60%; margin-left: 20%">
    <table class="table">
        <tr>
            <td style="width: 30%;">Quoted by:</td>
            <td style="width: 70%;" class="table-bordered"><?= $company->company_name;?><br><?= $company->address;?></td>
        </tr>
        <tr>
            <td style="width: 30%;">Quoted to:</td>
            <td style="width: 70%;"class="table-bordered"><?= $client->client_name; ?></td>
        </tr>
        <tr>
            <td style="width: 30%;">Quoted for:</td>
            <td style="width: 70%;" class="table-bordered"><?= $quotation->project_name;?></td>
        </tr>
        <tr>
            <td style="width: 30%;">Date: </td>
            <td style="width: 70%;"class="table-bordered"> <?= date("d-m-Y", strtotime($quotation->date));?><td>
        </tr>
    </table>
</div>



 <div class="table-responsive" style="margin-top: 10%;">
     <p class="text-left"><?= $quotation->note_up;?> </p>
    <table style="width: 100%;" class="table table-bordered text-center">

        <tr>
            <td colspan="5" class="" style="background: #ffb7b9;"> <h4><?=$quotation->project_name_header; ?> </h4></td>
        </tr>
        <tr>
            <th class="text-center" style="width: 40%;"></th>
            <th class="text-center" style="width: 15%;">Details</th>
            <th class="text-center" style="width: 15%;">Cost/Day</th>
            <th class="text-center" style="width: 15%;">Units</th>
            <th class="text-center" style="width: 15%;">Total</th>
        </tr>

        <?php
        $total = 0;
        foreach($section as $value){
            $sum = 0;
            ?>
            <tr>
                <td colspan="5" class=""> <h4><?=$value['section'];?> </h4></td>

            </tr>
            <?php
            $result = QuotationRef::find()->where(['ref'=>$quotation->ref,'section'=>$value['section']])->orderBy('id')->asArray()->all();
            foreach($result as $key=>$val){
                    $sum = $sum + $val['total'];
                ?>

                <tr>
                    <td style="width: 40%;"><?=$val['field_name'];?></td>
                    <td style="width: 15%;"><?=$val['details'];;?></td>
                    <td style="width: 15%;"><?=$val['cost_day'];;?></td>
                    <td style="width: 15%;"><?=$val['units'];?></td>
                    <td style="width: 15%;"><?=$val['total'];?></td>
                </tr>





            <?php
                $total = $total + $sum;

            }
            ?>

            <?
            // condition for sub total ...
            ?>

            <tr>
                <td colspan="4" class="text-right"></td>
                <td class="text-center"><?=$sum;?></td>
            </tr>

        <?php
        }
        ?>
        <tr>
            <td class="text-center" style="width: 40%;"> Total </td>
            <td colspan="3" class="text-right"></td>
            <td class="text-center"><?=$total;?></td>
        </tr>

    </table>
     <p class="text-left"><?= $quotation->note_down;?></p>
</div>


