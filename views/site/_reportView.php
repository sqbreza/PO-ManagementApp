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
$calculation =  $quotation->calculation;

$service_charge = unserialize($quotation->service_charge);

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



 <div class="table-responsive">
     <p class="text-left"><?= $quotation->note_up;?> </p>
    <table style="width: 100%;" class="table quotation text-center">

        <tr style="border: 1px solid grey;">
            <td colspan="5" class="" style="background: <?=$company->quotation_table_header_color;?>; color: #ffffff;"> <h4><?=$quotation->project_name_header; ?> </h4></td>
        </tr>


        <?php
        $total = 0;
        foreach($section as $sectionNo => $value){
            $sum = 0;
            ?>
            <tr style="border: 1px solid grey;">
                <td colspan="5" class=""> <h4><?=$value['section'];?> </h4></td>

            </tr>

            <tr style="border: 1px solid grey;">
                <th class="text-center" style="width: 40%; background: <?=$company->quotation_table_sub_header_color;?>;"></th>
                <th class="text-center" style="width: 15%; background: <?=$company->quotation_table_sub_header_color;?>;">Details</th>

                <?php if($calculation == 'Units'){ ?>
                    <th class="text-center" style="width: 15%; background: <?=$company->quotation_table_sub_header_color;?>;">Cost/Unit</th>
                    <th class="text-center" style="width: 15%; background: <?=$company->quotation_table_sub_header_color;?>;">Units</th>
                <?php }else{ ?>
                    <th class="text-center" style="width: 15%; background: <?=$company->quotation_table_sub_header_color;?>;">Amount</th>
                    <th class="text-center" style="width: 15%; background: <?=$company->quotation_table_sub_header_color;?>;">%</th>
                <?php }?>
                <th class="text-right" style="width: 15%; background: <?=$company->quotation_table_sub_header_color;?>;">Total</th>
            </tr>

            <?php
            $result = QuotationRef::find()->where(['ref'=>$quotation->ref,'section'=>$value['section']])->orderBy('id')->asArray()->all();
            foreach($result as $key=>$val){



                ?>

                <tr style="border: 1px solid grey;">
                    <td  style="width: 40%;" class="text-left"><?= $val['field_name'];?></td>
                    <td class="text-center" style="width: 15%;"><?=$val['details'];;?></td>
                    <td class="text-center" style="width: 15%;"><?=$val['cost_day'];;?></td>
                    <td class="text-center" style="width: 15%;"><?=$val['units'];?></td>
                    <td class="text-right" style="width: 15%;"><?= number_format($val['total'],2);?></td>
                </tr>





            <?php
                $sum = $sum + $val['total'];


            }

            if($sub_total == 1){
            ?>

                <tr style="border: 1px solid grey;">
                    <td colspan="4" class="text-right"></td>
                    <td class="text-right"> <strong> <?= number_format($sum,2);?> </strong> </td>
                </tr>

            <?php
            }

            $sc = ($sum * $service_charge[$sectionNo])/100;

            if($service_charge[$sectionNo] != 0) {
                ?>



                <tr style="border: 1px solid grey;">
                    <td colspan="4" class="text-left"> Service charge @ <?= $service_charge[$sectionNo]; ?> %</td>
                    <td class="text-right"><?= number_format($sc, 2); ?></td>
                </tr>

            <?php
            }
                $sum = $sum+ $sc;
            if(($sub_total == 1) AND ($service_charge[$sectionNo] != 0)) {
                ?>
                ?>

                <tr style="border: 1px solid grey;">
                    <td colspan="4" class="text-left"></td>
                    <td class="text-right"><strong> <?= number_format($sum, 2); ?> </strong></td>
                </tr>




            <?php
            }
            $total = $total + $sum;
        }
        $vat = $quotation->vat;
        $total_vat = ($total * $vat)/100 ;
        $total_with_vat =$total + $total_vat;

        if($vat != 0) {

            ?>
            <tr style="border: 1px solid grey;">
                <td colspan="5"> &nbsp; </td>
            </tr>
            <tr style="border: 1px solid grey;">
                <td class="text-left" style="width: 40%;"><strong>Grand Total(Excluding VAT) </strong></td>
                <td colspan="3" class="text-right"></td>
                <td class="text-center text-right"><strong><?= number_format($total, 2); ?></strong></td>
            </tr>



            <tr style="border: 1px solid grey;">
                <td class="text-left" style="width: 40%;"> VAT</td>
                <td colspan="3" class="text-center">@ <?= $vat; ?> %</td>
                <td class="text-center text-right"><?= number_format($total_vat, 2); ?></td>
            </tr>

            <tr style="border: 1px solid grey;">
                <td class="text-left" style="width: 40%;"><strong>Grand Total(Including VAT) </strong></td>
                <td colspan="3" class="text-center"></td>
                <td class="text-center text-right"><strong> <?= number_format($total_with_vat, 2); ?> </strong></td>
            </tr>

        <?php
        }else{

        ?>

            <tr style="border: 1px solid grey;">
                <td colspan="5"> &nbsp; </td>
            </tr>
            <tr style="border: 1px solid grey;">
                <td class="text-left" style="width: 40%;"><strong>Grand Total </strong></td>
                <td colspan="3" class="text-right"></td>
                <td class="text-center text-right"><strong><?= number_format($total, 2); ?></strong></td>
            </tr>

        <?php } ?>

    </table>
     <p class="text-left">In Words: <?= $quotation->amount_words;?> only. </p>
     <p class="text-left"><?= $quotation->note_down;?></p>
</div>


