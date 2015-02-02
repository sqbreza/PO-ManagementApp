<?php




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
            <td style="width: 70%;" class="table-bordered">Ice9 Interactive Ltd.<br> Floor:7, 50 lake Circus,Kalabagan, Dhaka-1207.</td>
        </tr>
        <tr>
            <td style="width: 30%;">Quoted to:</td>
            <td style="width: 70%;"class="table-bordered">Asiatic Marketing Communication Ltd.</td>
        </tr>
        <tr>
            <td style="width: 30%;">Quoted for:</td>
            <td style="width: 70%;" class="table-bordered">Airtel Vox pop AV</td>
        </tr>
        <tr>
            <td style="width: 30%;">Date: </td>
            <td style="width: 70%;"class="table-bordered">30/7/2014/<td>
        </tr>
    </table>
</div>



<div style="margin-top: 10%">
    <table style="width: 95%;" class="table">
        <tr>
            <th  style="background: lightpink; text-align: center;" colspan="5">Airtel Voxpop AV </th>
        </tr>
        <tr class="table-bordered">
            <th style="width: 40%;"></th>
            <th style="width: 15%;">Details</th>
            <th style="width: 15%;">Cost/Day</th>
            <th style="width: 15%;">Units</th>
            <th style="width: 15%;">Total</th>
        </tr>
        <?php
        foreach($quotation as $key=>$value):
        ?>
        <tr class="table-bordered">
            <td style="width: 40%;"><?=$value->field_name;?></td>
            <td style="width: 15%;"><?=$value->details;?></td>
            <td style="width: 15%;"><?=$value->cost_day;?></td>
            <td style="width: 15%;"><?=$value->units;?></td>
            <td style="width: 15%;"><?=$value->total;?></td>
        </tr>



        <?php

        endforeach;
        ?>
    </table>
</div>


