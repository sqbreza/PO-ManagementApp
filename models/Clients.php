<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property integer $id
 * @property string $client_name
 * @property string $address
 * @property string $vat_reg_no
 * @property string $prime_contact_personal
 * @property string $phone
 * @property string $email
 * @property string $notes
 *
 * @property Quotation[] $quotations
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_name', 'address'], 'required'],
            [['address', 'notes'], 'string'],
            [['client_name', 'vat_reg_no', 'prime_contact_personal', 'phone', 'email'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_name' => 'Client Name',
            'address' => 'Address',
            'vat_reg_no' => 'Vat Reg No',
            'prime_contact_personal' => 'Prime Contact Personal',
            'phone' => 'Phone',
            'email' => 'Email',
            'notes' => 'Notes',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuotations()
    {
        return $this->hasMany(Quotation::className(), ['client_company_id' => 'id']);
    }
}
