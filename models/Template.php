<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "template".
 *
 * @property integer $id
 * @property string $name
 * @property integer $company_id
 * @property string $type
 * @property string $calculation
 *
 * @property QuationRef[] $quationRefs
 * @property TemplateFields[] $templateFields
 */
class Template extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'company_id','type'], 'required'],
            [['company_id'], 'integer'],
            [['type','calculation'], 'string'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'company_id' => Yii::t('app', 'Company ID'),
            'type' => Yii::t('app', 'Type'),
            'Calculation Type' => Yii::t('app', 'Calculation'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuationRefs()
    {
        return $this->hasMany(QuationRef::className(), ['ref' => 'id']);
    }

    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplateFields()
    {
        return $this->hasMany(TemplateFields::className(), ['template_id' => 'id']);
    }
}
