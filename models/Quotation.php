<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "quotation".
 *
 * @property integer $id
 * @property string $ref
 * @property string $project_name
 * @property integer $company_id
 * @property integer $client_company_id
 * @property double $amount
 * @property string $po_no
 * @property string $date
 * @property string $status
 * @property integer $user_id
 * @property string $supervisor_name
 * @property integer $show_section_amount
 * @property string $file_name
 * @property string $note
 * @property string $created_time
 *
 * @property Clients $clientCompany
 * @property Company $company
 */
class Quotation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quotation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ref', 'project_name', 'company_id', 'client_company_id', 'amount', 'date', 'user_id', 'show_section_amount', 'created_time'], 'required'],
            [['company_id', 'client_company_id', 'user_id', 'show_section_amount'], 'integer'],
            [['amount'], 'number'],
            [['date', 'created_time'], 'safe'],
            [['note'], 'string'],
            [['ref', 'project_name', 'po_no', 'status', 'file_name'], 'string', 'max' => 255],
            [['supervisor_name'], 'string', 'max' => 11]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ref' => Yii::t('app', 'Ref'),
            'project_name' => Yii::t('app', 'Project Name'),
            'company_id' => Yii::t('app', 'Company ID'),
            'client_company_id' => Yii::t('app', 'Client Company ID'),
            'amount' => Yii::t('app', 'Amount'),
            'po_no' => Yii::t('app', 'Po No'),
            'date' => Yii::t('app', 'Date'),
            'status' => Yii::t('app', 'Status'),
            'user_id' => Yii::t('app', 'User ID'),
            'supervisor_name' => Yii::t('app', 'Supervisor Name'),
            'show_section_amount' => Yii::t('app', 'Show Section Amount'),
            'file_name' => Yii::t('app', 'File Name'),
            'note' => Yii::t('app', 'Note'),
            'created_time' => Yii::t('app', 'Created Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientCompany()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client_company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
}
