<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_language".
 *
 * @property integer $id_language
 * @property string $language
 * @property string $languageCode
 *
 * @property TblOwner[] $tblOwners
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_language';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_language'], 'required'],
            [['id_language'], 'integer'],
            [['language'], 'string', 'max' => 45],
            [['languageCode'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_language' => Yii::t('app', 'Id Language'),
            'language' => Yii::t('app', 'Language'),
            'languageCode' => Yii::t('app', 'Language Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwners()
    {
        return $this->hasMany(Owner::className(), ['idLanguage' => 'id_language']);
    }
}
