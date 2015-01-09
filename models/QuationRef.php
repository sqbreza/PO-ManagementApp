<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "quation_ref".
 *
 * @property integer $int
 * @property string $quotation_ref
 * @property integer $template_ref
 * @property string $section
 * @property string $field_name
 * @property string $details
 * @property double $cost_day
 * @property integer $units
 * @property double $total
 *
 * @property Quotation $quotationRef
 * @property Template $templateRef
 */
class QuationRef extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quation_ref';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quotation_ref', 'template_ref'], 'required'],
            [['template_ref', 'units'], 'integer'],
            [['cost_day', 'total'], 'number'],
            [['quotation_ref', 'section', 'field_name', 'details'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'int' => Yii::t('app', 'Int'),
            'quotation_ref' => Yii::t('app', 'Quotation Ref'),
            'template_ref' => Yii::t('app', 'Template Ref'),
            'section' => Yii::t('app', 'Section'),
            'field_name' => Yii::t('app', 'Field Name'),
            'details' => Yii::t('app', 'Details'),
            'cost_day' => Yii::t('app', 'Cost Day'),
            'units' => Yii::t('app', 'Units'),
            'total' => Yii::t('app', 'Total'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuotationRef()
    {
        return $this->hasOne(Quotation::className(), ['ref' => 'quotation_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplateRef()
    {
        return $this->hasOne(Template::className(), ['id' => 'template_ref']);
    }
}
