<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_services".
 *
 * @property integer $id_services
 * @property string $services
 * @property integer $id_house
 *
 * @property TblHouse[] $tblHouses
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['services', 'id_house'], 'required'],
            [['services'], 'string'],
            [['id_house'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_services' => Yii::t('app', 'Id Services'),
            'services' => Yii::t('app', 'Services'),
            'id_house' => Yii::t('app', 'Id House'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouses()
    {
        return $this->hasMany(House::className(), ['idservices' => 'id_house']);
    }
}
