<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_region".
 *
 * @property integer $id_region
 * @property string $regionName
 * @property integer $idProvince
 *
 * @property TblHouse[] $tblHouses
 * @property TblProvince $province
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idProvince'], 'integer'],
            [['regionName'], 'string', 'max' => 45],
            [['idProvince'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['idProvince' => 'id_province']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_region' => Yii::t('app', 'Id Region'),
            'regionName' => Yii::t('app', 'Region Name'),
            'idProvince' => Yii::t('app', 'Province'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouses()
    {
        return $this->hasMany(House::className(), ['idRegion' => 'id_region']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['id_province' => 'idProvince']);
    }
}
