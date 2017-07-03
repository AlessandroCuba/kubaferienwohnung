<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reservaType".
 *
 * @property integer $id
 * @property string $bookingType
 * @property integer $create_at
 * @property integer $update_at
 */
class ReservaType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reservaType';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bookingType', 'create_at', 'update_at'], 'required'],
            [['create_at', 'update_at'], 'integer'],
            [['bookingType'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'bookingType' => Yii::t('app', 'Booking Type'),
            'create_at' => Yii::t('app', 'Create At'),
            'update_at' => Yii::t('app', 'Update At'),
        ];
    }
}
