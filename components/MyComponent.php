<?php
namespace app\components;


use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use DateTime;
use DateTimeZone;
use app\models\RefGenerator;



class MyComponent extends Component
{

    public $dateFormat = 'Y-m-d H:i:s';

    public function welcome()
    {
        echo "Hello..Welcome to MyComponent";
        $date = new DateTime('now', new DateTimeZone('UTC'));
        echo $date->format($this->dateFormat).' '.$date->getTimestamp();
    }


    function generateQuotationRef($company,$type){

        //Get these from database
        $previous_date="";
        $previous_number="";
        $new_number="001";

        $model = RefGenerator::find()->orderBy('id DESC')->one();

        if(!empty($model)){
            $previous_date = $model->date;

            $previous_number = $model->serial;

        }


        $current_date = date("Y-m-d");


        if($current_date==$previous_date){

            $new_number=$previous_number+1;

            $new_number = sprintf("%03d", $new_number);

            $ref=substr($company,0,1)."Q".date("Ymd").$new_number;

           // return $ref;

            //commit new number to database


        }else{

            $ref=substr($company,0,1)."Q".date("Ymd").$new_number;

            //commit current_date to database. commit "001" as previous_number to database

           // return $ref;

        }


        $model =  new RefGenerator();

        $model->date = date("Ymd");
        $model->serial = $new_number;
        $model->type = $type;
        $model->company = $company;


        if($model->save()){
            return $ref;
        }



    }



}