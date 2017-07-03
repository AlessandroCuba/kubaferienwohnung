<?php

namespace common\models;

use Yii;
use common\models\Room;

/**
 * This is the model class for table "roomfacility".
 *
 * @property integer $id_facility
 * @property string $Denominations
 * @property string $Description
 * @property int $destination
 *
 * @property TblHouse[] $tblHouses
 */
class Facilities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'facility';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Denominations'], 'string', 'max' => 60],
            [['Description'], 'string', 'max' => 150],
            [['foto'], 'string', 'max' => 20],
            [['destination'], 'integer'], 
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_facility' => Yii::t('app', 'ID'),
            'Denominations' => Yii::t('app', 'Denominations'),
            'Description' => Yii::t('app', 'Description'),
            'foto' => Yii::t('app', 'Icon'),
            'destination' => Yii::t('app', 'Destination'),
        ];
    }
    
    /*public function getRoom() {
        return $this->hasMany(Room::className(), ['idroom' => 'room_id'])
                        ->viaTable('room_facilities', ['facility_id' => 'id_facility']);
    }*/

}
