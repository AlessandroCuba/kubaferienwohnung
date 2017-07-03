<?php

namespace common\models;
use common\models\House;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

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
    
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at']
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'idHouse', 'PersonenNo', 'idstatus'], 'integer'],
            [['CheckInDate', 'CheckOutDate'], 'safe'],
            [['idstatus'], 'required'],
            [['idHouse'], 'exist', 'skipOnError' => true, 'targetClass' => House::className(), 'targetAttribute' => ['idHouse' => 'id_house']],
            [['idstatus'], 'exist', 'skipOnError' => true, 'targetClass' => BoockStatus::className(), 'targetAttribute' => ['idstatus' => 'id_boockStatus']],
            [['idUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idUser' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_booking' => Yii::t('app', 'No'),
            'idUser' => Yii::t('app', 'User'),
            'idHouse' => Yii::t('app', 'House'),
            'CheckInDate' => Yii::t('app', 'Check In Date'),
            'CheckOutDate' => Yii::t('app', 'Check Out Date'),
            'PersonenNo' => Yii::t('app', 'Cantidad'),
            'idstatus' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Booking Date'),
            'updated_at' => Yii::t('app', 'Booking Update'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouse()
    {
        return $this->hasOne(House::className(), ['id_house' => 'idHouse']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(BoockStatus::className(), ['id_boockStatus' => 'idstatus']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }
}
