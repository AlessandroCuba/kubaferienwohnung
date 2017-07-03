<?php

namespace frontend\models;

use common\models\Region;
use common\models\Facilities;
use common\models\Services;
use common\models\Room;

use yii\helpers\Html;
use Yii;

use arogachev\ManyToMany\behaviors\ManyToManyBehavior;

/**
 * This is the model class for table "house".
 *
 * @property integer $id
 * @property integer $idRegion
 * @property integer $idOwner
 * @property string $houseName
 * @property string $houseDescription
 * @property string $houseAdresse
 * @property string $houseRating
 * @property integer $houseStatus
 * @property integer $houseFlag
 * @property integer $houseCreatedAt
 * @property integer $houseUpdateAt
 * @property string $houseFotos
 * @property integer $metadataId
 * @property integer $aeropuertoId
 * @property string $coordenadas
 *
 * @property TblOwner $idOwner0
 * @property TblRegion $idRegion0
 * @property HouseFacilities[] $houseFacilities
 * @property HouseService[] $houseServices
 * @property TblBooking[] $tblBookings
 * @property TblRoom[] $tblRooms
 */
class House extends \yii\db\ActiveRecord
{
    public $editableFacilitie = [];
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'house';
    }
    
    public function behaviors()
    {
        return [
            
            'manyToMany' => [
                'class' => ManyToManyBehavior::className(),
                'relations' => [
                    [
                    'name' => 'facilities',
                    // This is the same as in previous example
                    'editableAttribute' => 'editableFacilitie',
                    ],
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
            [['idRegion', 'idOwner', 'houseStatus', 'houseFlag', 'houseCreatedAt', 'houseUpdateAt'], 'integer'],
            [['houseAdresse', 'houseFotos'], 'string'],
            [['houseFotos'], 'required'],
            [['houseName', 'houseRating'], 'string', 'max' => 45],
            [['houseDescription'], 'string', 'max' => 256],
            [['idOwner'], 'exist', 'skipOnError' => true, 'targetClass' => Owner::className(), 'targetAttribute' => ['idOwner' => 'id_owner']],
            [['idRegion'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['idRegion' => 'id_region']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
         return [
            'id' => Yii::t('app', 'Id House'),
            'idRegion' => Yii::t('app', 'Id Region'),
            'idOwner' => Yii::t('app', 'Id Owner'),
            'metadataId' => Yii::t('app', 'Metadata ID'),
            'aeropuertoId' => Yii::t('app', 'Aeropuerto ID'),
            'houseName' => Yii::t('app', 'House Name'),
            'houseDescription' => Yii::t('app', 'House Description'),
            'houseAdresse' => Yii::t('app', 'House Adresse'),
            'houseRating' => Yii::t('app', 'House Rating'),
            'houseStatus' => Yii::t('app', 'House Status'),
            'houseFlag' => Yii::t('app', 'House Flag'),
            'houseCreatedAt' => Yii::t('app', 'House Created At'),
            'houseUpdateAt' => Yii::t('app', 'House Update At'),
            'houseFotos' => Yii::t('app', 'House Fotos'),
            'coordenadas' => Yii::t('app', 'Coordenadas'),
        ];
    }
    
    public static function getRegionList($cat_id)
    {
        $data = Region::find()
                ->where(['idProvince' => $cat_id])
                ->asArray()
                ->all();
        foreach ($data as $dat) {
            $out[] = ['id' => $dat['id_region'], 'name' => $dat['regionName']];
        }
        return $output = [
            'output' => $out,
            'selected' => ''
        ];
    }

    public function geticonsSet($attribute){
        $iconsSet = $attribute ? @explode(',',$attribute) : [];
        $icons = '';
        foreach ($iconsSet as $icon){
            $icons.= ' '.Html::img(Yii::getAlias('@imgIconsSet').'/'.$icon.'.svg', ['style'=>'max-width:25px;', 'alt'=>$icon]);
        }
        return $icons;
    }
    
    public function getstarRating(){
        if(!empty($this->houseRating)){
            for($i=0; $i< $this->houseRating; $i++){
                    echo '<i class="fa fa-star"></i>';
                }
        }
        return true;    
    }
    
    public function getcolorRating (){
        if(!empty($this->houseRating)){
            switch ($this->houseRating){
                case 1 :
                    $color = 'verybad';
                    break;
                case 2 :
                    $color = 'bad';
                    break;
                case 3 :
                    $color = 'good';
                    break;
                case 4 :
                    $color = 'verygood';
                    break;
                case 5 :
                    $color = 'excelent';
                    break;
            }
        return $color;
        }
    }

    public function getphotosViewerAleatory(){
        $fotos = $this->houseFotos ? @explode(',',$this->houseFotos) : [];
        $imagenes = '';
        foreach ($fotos as $houseFotos){
            $imagenes = Html::img(Yii::getAlias('@imgCasasUrl').'/'.$houseFotos);
        }
        return $imagenes;
    }
    
    public function getphotosView(){
        $fotos = $this->houseFotos ? @explode(',',$this->houseFotos) : [];
        $imagenes = '';
        foreach ($fotos as $houseFotos){
            $imagenes   = '<div class="item">'.Html::img(Yii::getAlias('@imgCasasUrl').'/'.$houseFotos).'</div>';
        }
        return $imagenes;
    }
    
    public function getroomList($id){
        $array_roomlist = Room::find()->where(['houseId' => $id])->orderBy('idroom')->all();
        /*$roomList = array();
        foreach ($array_roomlist as $roomlist){
            $roomList[] = '<tr><td>'.' '.$roomlist->roomCapacity.'</td> <td>'.$roomlist->roomDimension.'</td></tr>';
        }*/
        $roomList = new \yii\data\ActiveDataProvider($array_roomlist);
        
        return $roomList; //implode('',$roomList); 
    }

    //========================= RELACIONES =========================
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getroomType(){

        $roomtype = ArrayHelper::map(Roomtype::find()->orderBy('idroomtype')->all(),'idroomtype','typeRoom');
        return $roomtype;
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getServices()
    {
        return $this->hasMany(Services::className(), ['id_service' => 'service_id'])
                ->viaTable('{{%house_service}}',['house_id' => 'id']);
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getFacilities()
    {
        return $this->hasMany(Facilities::className(), ['id_facility' => 'facilities_id'])
                ->viaTable('{{%house_facilities}}',['house_id' => 'id']);
    }
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getrooms()
    {
        return $this->hasMany(Room::className(), ['houseId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['idHouse' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(Owner::className(), ['id_owner' => 'idOwner']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id_region' => 'idRegion'])->with(['province']);
    }
}
