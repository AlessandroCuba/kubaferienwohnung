<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "fotos".
 *
 * @property integer $id
 * @property integer $houseid
 * @property string $fotoName
 * @property integer $create_at
 * @property integer $update_at
 *
 * @property House $house
 */
class Fotos extends \yii\db\ActiveRecord
{
    public $images;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fotos';
    }
    
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_at', 'update_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_at']
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
            [['houseid', 'fotoName', 'create_at', 'update_at'], 'required'],
            [['houseid', 'create_at', 'update_at'], 'integer'],
            [['fotoName'], 'string'],
            [['fotoName'], 'file', 
                'maxFiles' => 10, 'tooMany' => 'Maximum {limit} images',
                'extensions' => 'jpg, png',
                //'skipOnEmpty' => true, 
            ],
            [['images'], 'file', 
                //'skipOnEmpty' => true, 
                'maxFiles' => 10, 'tooMany' => 'Maximum {limit} images',
                'extensions' => 'png, jpg'
            ],
            [['houseid'], 'exist', 'skipOnError' => true, 'targetClass' => House::className(), 'targetAttribute' => ['houseid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'houseid' => Yii::t('app', 'Houseid'),
            'fotoName' => Yii::t('app', 'Foto Name'),
            'create_at' => Yii::t('app', 'Create At'),
            'update_at' => Yii::t('app', 'Update At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouse()
    {
        return $this->hasOne(House::className(), ['id' => 'houseid']);
    }
}
