<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "template_fields".
 *
 * @property integer $id
 * @property integer $template_id
 * @property string $section
 * @property string $field_name
 * @property string $template_type
 *
 * @property Template $template
 */
class TemplateFields extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'template_fields';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template_id'], 'integer'],
            [['section', 'field_name', 'template_type'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'template_id' => Yii::t('app', 'Template ID'),
            'section' => Yii::t('app', 'Section'),
            'field_name' => Yii::t('app', 'Field Name'),
            'template_type' => Yii::t('app', 'Template Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(Template::className(), ['id' => 'template_id']);
    }
}
