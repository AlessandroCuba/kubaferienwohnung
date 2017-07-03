<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_BoockStatus".
 *
 * @property int $id_boockStatus
 * @property string $statusDescription
 *
 * @property TblBooking[] $tblBookings
 */
class BoockStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_BoockStatus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['statusDescription'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_boockStatus' => Yii::t('app', 'Id Boock Status'),
            'statusDescription' => Yii::t('app', 'Status Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblBookings()
    {
        return $this->hasMany(TblBooking::className(), ['idstatus' => 'id_boockStatus']);
    }
}
