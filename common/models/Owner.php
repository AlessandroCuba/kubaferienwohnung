<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tbl_owner".
 *
 * @property integer $id_owner
 * @property string $ownerName
 * @property string $ownerLastName
 * @property string $ownerBirthday
 * @property string $ownerTelef
 * @property string $ownerPhone
 * @property string $ownerEmail
 * @property string $ownerOthers 
 * @property string $ownerPassword
 * @property resource $ownerAvatar
 * @property integer $ownerCreatedAt
 * @property string $ownerUpdateAt
 * @property integer $idLanguage
 *
 * @property TblHouse[] $tblHouses
 * @property TblLanguage $language
 */
class Owner extends \yii\db\ActiveRecord
{
    public $file;
    
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['ownerCreatedAt', 'ownerUpdateAt'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['ownerUpdateAt']
                ]
            ],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_owner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ownerName', 'ownerLastName','ownerPhone','ownerBirthday',], 'required'], 
            [['file', 'ownerBirthday'], 'safe'], 
            ['ownerEmail', 'filter', 'filter' => 'trim'],
            ['ownerEmail', 'email'],
            ['ownerEmail', 'unique'],
            [['file'], 'file', 
                'extensions'=>'jpg, png',
                'maxFiles' => 1, 'tooMany' => 'Maximum {limit} images'
            ],
            [['ownerCreatedAt', 'idLanguage'], 'integer'],
            [['ownerName', 'ownerLastName', 'ownerTelef', 'ownerPhone', 'ownerEmail', 'ownerPassword', 'ownerAvatar', 'ownerUpdateAt'], 'string', 'max' => 45],
            [['idLanguage'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['idLanguage' => 'id_language']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_owner' => Yii::t('app', 'Id Owner'),
            'ownerName' => Yii::t('app', 'Name'),
            'ownerLastName' => Yii::t('app', 'Last Name'),
            'ownerBirthday' => Yii::t('app', 'Birthday'), 
            'ownerTelef' => Yii::t('app', 'Telef'),
            'ownerPhone' => Yii::t('app', 'Phone'),
            'ownerEmail' => Yii::t('app', 'Email'),
            'ownerPassword' => Yii::t('app', 'Password'),
            'ownerAvatar' => Yii::t('app', 'Avatar'),
            'ownerCreatedAt' => Yii::t('app', 'Created'),
            'ownerUpdateAt' => Yii::t('app', 'Update'),
            'idLanguage' => Yii::t('app', 'Language'),
            'ownerOthers' => Yii::t('app', 'Notes'),
            'file' => Yii::t('app', 'Photo')
        ];
    }
    
    public function upload(){
        if ($this->validate()) {
            $this->ownerAvatar = 'avat'.time().'.'.$this->ownerAvatar->extension;
            $this->ownerAvatar->saveAs(Yii::getAlias('@imgAvatarsPath').'/'. $this->ownerAvatar);
            return true;
        } else {
            return false;
        }
    }
    
    public function getOwnerNameFull(){
        return $this->ownerName.' '.$this->ownerLastName;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouses()
    {
        return $this->hasMany(House::className(), ['idOwner' => 'id_owner']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id_language' => 'idLanguage']);
    }
}
