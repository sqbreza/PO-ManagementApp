<?php
namespace app\components;


use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use DateTime;
use DateTimeZone;



class MyComponent extends Component
{

    public $dateFormat = 'Y-m-d H:i:s';

    public function welcome()
    {
        echo "Hello..Welcome to MyComponent";
        $date = new DateTime('now', new DateTimeZone('UTC'));
        echo $date->format($this->dateFormat).' '.$date->getTimestamp();
    }


    function generateQuotationRef($company){

        //Get these from database
        $previous_date="17-01-2015";
        $previous_number="005";


        $current_date = date("d-m-Y");

        if($current_date==$previous_date){

            $new_number=$previous_number+1;

            $new_number = sprintf("%03d", $new_number);

            $ref=substr($company,0,1)."Q".date("ymd").$new_number;

            return $ref;

            //commit new number to database


        }else{

            $ref=substr($company,0,1)."Q".date("ymd")."001";

            //commit current_date to database. commit "001" as previous_number to database

            return $ref;

        }


    }



}