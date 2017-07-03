<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_roomtype".
 *
 * @property integer $idroomtype
 * @property string $typeRoom
 * @property string $typeDesc
 */
class Roomtype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roomtype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['typeRoom', 'typeDesc'], 'required'],
            [['typeRoom'], 'string', 'max' => 25],
            [['typeDesc'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idroomtype' => Yii::t('app', 'Idroom'),
            'typeRoom' => Yii::t('app', 'Type Room'),
            'typeDesc' => Yii::t('app', 'Type Desc'),
        ];
    }
}
