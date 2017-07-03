<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_faq".
 *
 * @property integer $id_faq
 * @property string $faqTitel
 * @property string $faqDescription
 */
class Faq extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_faq';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['faqTitel'], 'required'],
            [['faqDescription'], 'string'],
            [['faqTitel'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_faq' => Yii::t('app', 'Id Faq'),
            'faqTitel' => Yii::t('app', 'Faq Titel'),
            'faqDescription' => Yii::t('app', 'Faq Description'),
        ];
    }
}
