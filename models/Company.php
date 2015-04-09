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
 * @property double $company_vat
 * @property string $contact_no
 * @property string $email
 * @property string $website
 *
 * @property Quotation[] $quotations
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
            [['company_name', 'address', 'contact_no', 'email', 'website'], 'string', 'max' => 255]
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
            'company_vat' => Yii::t('app', 'Company Vat'),
            'contact_no' => Yii::t('app', 'Contact No'),
            'email' => Yii::t('app', 'Email'),
            'website' => Yii::t('app', 'Website'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuotations()
    {
        return $this->hasMany(Quotation::className(), ['company_id' => 'id']);
    }
}
