<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

use common\models\Facilities;


/**
 * This is the model class for table "room".
 *
 * @property integer $idroom
 * @property integer $houseId
 * @property integer $typeId
 * @property string $Description
 * @property integer $Adult
 * @property integer $Children
 * @property double $roomDimension
 * @property integer $lowPrice
 * @property integer $highPrice
 * @property integer $roomStatus
 * @property string $roomfacilities
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property House $house
 * @property Roomtype $type
 * @property RoomFacilities[] $roomFacilities
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room';
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
            [['typeId', 'Description', 'Adult', 'Children', 'roomDimension', 'lowPrice', 'highPrice', 'roomStatus', 'roomfacilities'], 'required'],
            [['typeId', 'Adult', 'Children', 'lowPrice', 'highPrice', 'roomStatus', 'created_at', 'updated_at'], 'integer'],
            [['roomDimension'], 'number'],
            //[['roomfacilities'], 'string'],
            [['Description'], 'string', 'max' => 256],
            //[['houseId'], 'exist', 'skipOnError' => true, 'targetClass' => House::className(), 'targetAttribute' => ['houseId' => 'id']],
            [['typeId'], 'exist', 'skipOnError' => true, 'targetClass' => Roomtype::className(), 'targetAttribute' => ['typeId' => 'idroomtype']],
        ];
    }

    /**
     * @inheritdoc
     */
     public function attributeLabels()
    {
        return [
            'idroom' => Yii::t('app', 'Idroom'),
            'houseId' => Yii::t('app', 'House ID'),
            'typeId' => Yii::t('app', 'Type ID'),
            'Description' => Yii::t('app', 'Description'),
            'Adult' => Yii::t('app', 'Adult'),
            'Children' => Yii::t('app', 'Children'),
            'roomDimension' => Yii::t('app', 'Room Dimension'),
            'lowPrice' => Yii::t('app', 'Low Price'),
            'highPrice' => Yii::t('app', 'High Price'),
            'roomStatus' => Yii::t('app', 'Room Status'),
            'roomfacilities' => Yii::t('app', 'Roomfacilities'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getroomFacilities(){
        $data = ArrayHelper::map(Facilities::find()->where(['destination' => ['2','3']])->asArray()->all(), 'id_facility', 'Denominations');
        return $data;
    }
    
    public function getFacilities() {
        return $this->hasMany(Facilities::className(), ['id_facility' => 'facility_id'])
                        ->viaTable('room_facilities', ['room_id' => 'idroom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouse()
    {
        return $this->hasOne(House::className(), ['id' => 'houseId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Roomtype::className(), ['idroomtype' => 'typeId']);
    }
}