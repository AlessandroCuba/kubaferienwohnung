<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_province".
 *
 * @property integer $id_province
 * @property string $provinceName
 * @property string $provinceCode
 *
 * @property TblRegion[] $tblRegions
 */
class Province extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_province'], 'integer'],
            [['provinceName'], 'string', 'max' => 45],
            [['provinceCode'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_province' => Yii::t('app', 'No.'),
            'provinceName' => Yii::t('app', 'Province Name'),
            'provinceCode' => Yii::t('app', 'Province Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasMany(Region::className(), ['idProvince' => 'id_province']);
    }
}
