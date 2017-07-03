<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_booking".
 *
 * @property int $id_booking
 * @property int $idUser
 * @property int $idHouse
 * @property string $CheckInDate
 * @property string $CheckOutDate
 * @property int $PersonenNo
 * @property int $idstatus
 * @property int $created_at
 * @property int $updated_at
 *
 * @property TblHouse $house
 * @property TblBoockStatus $status
 * @property User $user
 */
class Booking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_booking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'idHouse', 'PersonenNo', 'idstatus', 'created_at', 'updated_at'], 'integer'],
            [['CheckInDate', 'CheckOutDate'], 'safe'],
            [['idstatus', 'created_at', 'updated_at'], 'required'],
            [['idHouse'], 'exist', 'skipOnError' => true, 'targetClass' => TblHouse::className(), 'targetAttribute' => ['idHouse' => 'id_house']],
            [['idstatus'], 'exist', 'skipOnError' => true, 'targetClass' => TblBoockStatus::className(), 'targetAttribute' => ['idstatus' => 'id_boockStatus']],
            [['idUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idUser' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_booking' => Yii::t('app', 'Id Booking'),
            'idUser' => Yii::t('app', 'Id User'),
            'idHouse' => Yii::t('app', 'Id House'),
            'CheckInDate' => Yii::t('app', 'Check In Date'),
            'CheckOutDate' => Yii::t('app', 'Check Out Date'),
            'PersonenNo' => Yii::t('app', 'Personen No'),
            'idstatus' => Yii::t('app', 'Idstatus'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouse()
    {
        return $this->hasOne(TblHouse::className(), ['id_house' => 'idHouse']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(TblBoockStatus::className(), ['id_boockStatus' => 'idstatus']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }
}
