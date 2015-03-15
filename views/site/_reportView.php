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


$sub_total =  $quotation->show_section_amount;
$calculation =  $template->calculation;



?>


<div style="width: 60%; margin-left: 20%;">
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
            <td colspan="5" class="" style="background: #ed5b29;color: #ffffff;"> <h4><?=$quotation->project_name_header; ?> </h4></td>
        </tr>
        <tr>
            <th class="text-center" style="width: 40%;"></th>
            <th class="text-center" style="width: 15%;">Details</th>
            <th class="text-center" style="width: 15%;">Cost/Day</th>
           <?php if($calculation == 'Units'){ ?>
            <th class="text-center" style="width: 15%;">Units</th>
            <?php }else{ ?>
               <th class="text-center" style="width: 15%;">%</th>
            <?php }?>
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
                    <td  style="width: 40%;"><?=$val['field_name'];?></td>
                    <td class="text-right" style="width: 15%;"><?=$val['details'];;?></td>
                    <td class="text-right" style="width: 15%;"><?=$val['cost_day'];;?></td>
                    <td class="text-right" style="width: 15%;"><?=$val['units'];?></td>
                    <td class="text-right" style="width: 15%;"><?=$val['total'];?></td>
                </tr>





            <?php
                $total = $total + $sum;

            }if($sub_total == 1){
            ?>

                <tr>
                    <td colspan="4" class="text-right"></td>
                    <td class="text-right"><?= $sum; ?></td>
                </tr>

            <?php
            }
        }
        ?>
        <tr>
            <td class="text-center" style="width: 40%;"> Total </td>
            <td colspan="3" class="text-right"></td>
            <td class="text-center text-right"><?=$total;?></td>
        </tr>

    </table>
     <p class="text-left"><?= $quotation->note_down;?></p>
</div>


