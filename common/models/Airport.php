<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "airport".
 *
 * @property integer $id
 * @property string $name
 * @property string $coorAirport
 * @property integer $create
 * @property integer $update
 *
 * @property HouseAirport[] $houseAirports
 */
class Airport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'airport';
    }
    
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created', 'updated'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated']
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
            [['name', 'coorAirport', 'create', 'update'], 'required'],
            [['coorAirport'], 'string'],
            [['create', 'update'], 'integer'],
            [['name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Airport Name'),
            'coorAirport' => Yii::t('app', 'Coordenate Airport'),
            'create' => Yii::t('app', 'Create'),
            'update' => Yii::t('app', 'Update'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouseAirports()
    {
        return $this->hasMany(HouseAirport::className(), ['airportId' => 'id']);
    }
}
