<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file_archive".
 *
 * @property integer $id
 * @property string $ref
 * @property string $file_name
 * @property string $type
 */
class FileArchive extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file_archive';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ref', 'file_name', 'type'], 'required'],
            [['ref', 'file_name', 'type'], 'string', 'max' => 255]
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
            'file_name' => Yii::t('app', 'File Name'),
            'type' => Yii::t('app', 'Type'),
        ];
    }
}
