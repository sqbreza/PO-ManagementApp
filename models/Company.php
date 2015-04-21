<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $company_name
 * @property string $address
 * @property string $established_date
 * @property integer $total_employee
 * @property string $contact_no
 * @property string $email
 * @property string $website
 * @property double $company_vat
 * @property string $quotation_header_image
 * @property string $quotation_table_header_color
 * @property string $quotation_table_sub_header_color
 * @property string $quotation_watermark_image
 * @property string $bill_header_image
 * @property string $bill_table_header_color
 * @property string $bill_table_sub_header_color
 * @property string $bill_watermark_image
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_name', 'address'], 'required'],
            [['established_date'], 'safe'],
            [['total_employee'], 'integer'],
            [['company_vat'], 'number'],
            [['company_name', 'address', 'contact_no', 'email', 'website', 'quotation_header_image', 'quotation_table_header_color', 'quotation_table_sub_header_color', 'quotation_watermark_image', 'bill_header_image', 'bill_table_header_color', 'bill_table_sub_header_color', 'bill_watermark_image'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'company_name' => Yii::t('app', 'Company Name'),
            'address' => Yii::t('app', 'Address'),
            'established_date' => Yii::t('app', 'Established Date'),
            'total_employee' => Yii::t('app', 'Total Employee'),
            'contact_no' => Yii::t('app', 'Contact No'),
            'email' => Yii::t('app', 'Email'),
            'website' => Yii::t('app', 'Website'),
            'company_vat' => Yii::t('app', 'Company Vat'),
            'quotation_header_image' => Yii::t('app', 'Quotation Header Image'),
            'quotation_table_header_color' => Yii::t('app', 'Quotation Table Header Color'),
            'quotation_table_sub_header_color' => Yii::t('app', 'Quotation Table Sub Header Color'),
            'quotation_watermark_image' => Yii::t('app', 'Quotation Watermark Image'),
            'bill_header_image' => Yii::t('app', 'Bill Header Image'),
            'bill_table_header_color' => Yii::t('app', 'Bill Table Header Color'),
            'bill_table_sub_header_color' => Yii::t('app', 'Bill Table Sub Header Color'),
            'bill_watermark_image' => Yii::t('app', 'Bill Watermark Image'),
        ];
    }
}
