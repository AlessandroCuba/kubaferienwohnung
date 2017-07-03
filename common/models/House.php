<?php

namespace common\models;

use Yii;

use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\helpers\Html;

use common\models\Roomtype;
use common\models\Region;

use v0lume\yii2\metaTags\MetaTagBehavior;
use arogachev\ManyToMany\behaviors\ManyToManyBehavior;
use arogachev\ManyToMany\validators\ManyToManyValidator;
/**
 * This is the model class for table "house".
 *
 * @property integer $id
 * @property integer $idRegion
 * @property integer $idOwner
 * @property integer $typeReserveId
 * @property integer $aeropuertoId
 * @property integer $metadataId
 * @property string $houseName
 * @property string $houseDescription
 * @property string $houseAdresse
 * @property string $houseRating
 * @property integer $houseStatus
 * @property integer $houseFlag
 * @property integer $houseCreatedAt
 * @property integer $houseUpdateAt
 * @property string $houseFotos
 * @property string $coordenadas
 *
 * @property TblOwner $idOwner0
 * @property TblRegion $idRegion0
 * @property HouseAirport[] $houseAirports
 * @property HouseFacilities[] $houseFacilities
 * @property HouseService[] $houseServices
 * @property Room[] $rooms
 */

class House extends \yii\db\ActiveRecord
{
    public $provincia;
    public $latitud;
    public $longitud;
    public $fotos = [];
    public $price;
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
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['houseCreatedAt', 'houseUpdateAt'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['houseUpdateAt']
                ]
            ],
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
            'MetaTag' => [
                'class' => MetaTagBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idRegion', 'idOwner', 'typeReserveId', 'aeropuertoId', 'houseStatus', 'houseFlag', 'houseCreatedAt', 'houseUpdateAt'], 'integer'],
            [['typeReserveId', 'aeropuertoId'], 'required'],
            [['houseAdresse'], 'string'],
            [['houseName', 'houseRating'], 'string', 'max' => 45],
            [['coordenadas', 'fotos[]', 'provincia', 'latitud', 'longitud'], 'safe'],
            [['houseFotos'], 'file', 
                'maxFiles' => 10, 'tooMany' => 'Maximum {limit} images',
                'extensions' => 'jpg, png',
            ],
            [['fotos'], 'file', 
                'maxFiles' => 10, 'tooMany' => 'Maximum {limit} images',
                'extensions' => 'png, jpg'
            ],
            ['editableFacilitie', ManyToManyValidator::className()],
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
            'idRegion' => Yii::t('app', 'Region'),
            'idOwner' => Yii::t('app', 'Owner Name'),
            'typeReserveId' => Yii::t('app', 'Type Reserve'),
            'aeropuertoId' => Yii::t('app', 'Airport'),
            'houseName' => Yii::t('app', 'House Name'),
            'houseDescription' => Yii::t('app', 'House Description'),
            'houseAdresse' => Yii::t('app', 'House Adresse'),
            'houseRating' => Yii::t('app', 'House Rating'),
            'houseStatus' => Yii::t('app', 'House Status'),
            'houseFlag' => Yii::t('app', 'House Flag'),
            'houseCreatedAt' => Yii::t('app', 'Created at'),
            'houseUpdateAt' => Yii::t('app', 'Update at'),
            'houseFotos' => Yii::t('app', 'House Fotos'),
            'coordenadas' => Yii::t('app', 'Coordenadas'),
        ];
    }


    //================================================
    //           Carga de Multiple Fotos 
    //================================================
    
    public function uploadMultiple($model,$attribute)
    {
        $fotosgroup  = UploadedFile::getInstances($model, $attribute);
        $path = Yii::getAlias('@imgCasasPath').'/';
        
        if ($this->validate() && $fotosgroup !== null) {
            $fileNames = [];
            foreach ($fotosgroup as $houseFotos){
                $fileName = md5($houseFotos->baseName.time()) . '.' . $houseFotos->extension;
                  if($houseFotos->saveAs($path . $fileName)){
                    $fileNames[] = $fileName;
                  }
            }
            if($model->isNewRecord){
                return implode(',', $fileNames);
            }else{
                return implode(',',(ArrayHelper::merge($fileNames,$model->getOwnPhotosToArray())));
          }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }
    
    //================================================
    //          Obtiene URL imagen 
    //================================================
    public function geturlImages(){
        $fotos = $this->houseFotos ? @explode(',',$this->houseFotos) : [];
        $urlimagenes = '';
        if(!empty($fotos)){
            foreach ($fotos as $houseFotos){
                $urlimagenes[]= ' '.Yii::getAlias('@imgCasasUrl').'/'.$houseFotos;
            }
        }
        return $urlimagenes;
    }
    
    //================================================
    //          Lista las Habitaciones
    //================================================
    public function getroomList($id){
        $array_roomlist = Room::find()->where(['houseId' => $id])->orderBy('idroom')->all();
        /*$roomList = array();
        foreach ($array_roomlist as $roomlist){
            $roomList[] = '<tr><td>'.' '.$roomlist->roomCapacity.'</td> <td>'.$roomlist->roomDimension.'</td></tr>';
        }*/
        $roomList = new \yii\data\ActiveDataProvider($array_roomlist);
        
        return $roomList; //implode('',$roomList); 
    }
    
    //================================================
    //          Obtiene Datos de la imagen 
    //================================================
    public function getfotoData(){

        if(!$this->isNewRecord){
            $fotos = $this->houseFotos ? @explode(',',$this->houseFotos) : [];
            if($fotos){
            foreach ($fotos as $fotoData){
                $filesizePath = Yii::getAlias('@imgCasasPath').'/'.$fotoData;
                $fotosDatas[] = ['caption' => basename($fotoData), 'size' => filesize($filesizePath)];
            }
            return $fotosDatas;
            }
            return false;
        }
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
    
     
    //================================================
    //          Imprime Array Foto en View 
    //================================================    
    public function geticonsSet($attribute){
        $iconsSet = $attribute ? @explode(',',$attribute) : [];
        $icons = '';
        foreach ($iconsSet as $icon){
            $icons.= ' '.Html::img(Yii::getAlias('@imgIconsSet').'/'.$icon.'.svg', ['class'=>'img-thumbnail','style'=>'max-width:50px;', 'alt'=>$icon]);
        }
        return $icons;
    }

    //================================================
    //          Imprime Array Foto en View 
    //================================================    
    public function getphotosViewer(){
        $fotos = $this->houseFotos ? @explode(',',$this->houseFotos) : [];
        $imagenes = '';
        foreach ($fotos as $houseFotos){
            $imagenes.= ' '.Html::img(Yii::getAlias('@imgCasasUrl').'/'.$houseFotos,['class'=>'owl-item active','style'=>'max-width:250px;']);
        }
        return $imagenes;
    }
    
    public function getroomType(){

        $roomtype = ArrayHelper::map(Roomtype::find()->orderBy('idroomtype')->all(),'idroomtype','typeRoom');
        return $roomtype;
    }

    public function getOwnPhotosToArray()
    {
      return $this->getOldAttribute('houseFotos') ? @explode(',',$this->getOldAttribute('houseFotos')) : [];
    }
    
    public function getFacilitiesArray(){
        $facilitiesArray = ArrayHelper::map(Facilities::find()->where(['destination' => ['1', '3']])->asArray()->all(), 'id_facility', 'Denominations');
        return $facilitiesArray;
    }
    
    public function getServicesArray(){
        $servicesArray = ArrayHelper::map(Services::find()->asArray()->all(), 'id_service', 'Denominations');
        return $servicesArray;
    }
    

    //================= Relations =================
    
    public function getHouseAirports()
    {
        return $this->hasMany(HouseAirport::className(), ['houseId' => 'id']);
    }
    public function getAirport()
    {
        return $this->hasMany(Airport::className(), ['id' => 'airportId'])
                ->viaTable('{{%house_airport}}',['houseId' => 'id']);
    }
    
    public function getFotos(){
        return $this->hasMany(Fotos::className(), ['houseid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouseFacilities()
    {
        return $this->hasMany(HouseFacilities::className(), ['house_id' => 'id']);
    }
    public function getFacilities()
    {
        return $this->hasMany(Facilities::className(), ['id_facility' => 'facilities_id'])
                ->viaTable('{{%house_facilities}}',['house_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouseServices()
    {
        return $this->hasMany(HouseService::className(), ['house_id' => 'id']);
    }
    
    public function getServices()
    {
        return $this->hasMany(Services::className(), ['id_service' => 'service_id'])
                ->viaTable('{{%house_service}}',['house_id' => 'id']);
    }
    
    public function getRooms()
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
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id_region' => 'idRegion']);
    }
}
