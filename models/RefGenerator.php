<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_generator".
 *
 * @property integer $id
 * @property string $date
 * @property integer $serial
 * @property string $type
 * @property string $company
 */
class RefGenerator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_generator';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['serial'], 'integer'],
            [['type', 'company'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
            'serial' => Yii::t('app', 'Serial'),
            'type' => Yii::t('app', 'Type'),
            'company' => Yii::t('app', 'Company'),
        ];
    }
}
