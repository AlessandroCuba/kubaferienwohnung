<?php

namespace frontend\models;

use Yii;
use yii\db\Query;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\House;
use common\models\Booking;

/**
 * HouseSearch represents the model behind the search form of `common\models\House`.
 */
class HouseSearch extends House
{
    
    public $province;
    public $region;
    public $lowPrice;
    public $highPrice;
    public $facilities = [];
    public $roomCapacity;
    public $dateFrom;
    public $dateTo;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'idRegion'], 'integer'],
            [['idRegion','houseRating', 'dateTo', 'dateFrom', 'facilities[]', 'roomCapacity', 'province', 'region'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    
    public function search($params)
    {
        $dateTo     = strtotime($this->dateTo);
        $dateFrom   = strtotime($this->dateFrom);
        
        $subQuery = Booking::find()
                    ->select('idHouse')->asArray();
        
        $query = House::find()->from('house h')
                ->leftJoin('house_facilities hf', 'hf.house_id = h.id')
                ->leftJoin('facility f', 'f.id_facility = hf.facilities_id')
                ->leftJoin('room room', 'room.houseId = h.id')
                ->leftJoin('tbl_region r', 'h.idRegion = r.id_region')
                ->leftJoin('tbl_province p', 'p.id_province = r.idProvince')
                ->where(['houseFlag' => 1]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        
        $dataProvider->sort->attributes['region'] = [
            'asc' => ['tbl_region.regionName' => SORT_ASC],
            'desc' => ['tbl_region.regionName' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['houseRating'] = [
            
        ];

        $dataProvider->sort->attributes['province'] = [
            'asc' => ['tbl_province.provinceName' => SORT_ASC],
            'desc' => ['tbl_province.provinceName' => SORT_DESC],
        ];
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        if($this->dateTo||$this->dateFrom){
            $subQuery   ->andFilterWhere([
                            'AND', 
                                ['<=', 'CheckInDate', strtotime($this->dateFrom)],
                                ['>=', 'CheckOutDate', strtotime($this->dateTo)],
                        ]);
            $subQuery   ->orFilterWhere([
                            'AND',
                                ['<', 'CheckInDate', strtotime($this->dateTo)],
                                ['>=', 'CheckOutDate', strtotime($this->dateTo)],
                        ]);
            $subQuery   ->orFilterWhere([
                            'AND',
                                ['<=', 'CheckInDate', strtotime($this->dateTo)],
                                ['>=', 'CheckOutDate', strtotime($this->dateFrom)],
                        ]);
            $query ->where(['NOT IN', 'id', $subQuery]);
        }
        
        if($this->lowPrice){
            $query  ->andWhere('<=', 'room.lowPrice', $this->lowPrice)
                    ->andWhere('>=', 'room.highPrice', $this->highPrice);
        }
        
        $query->andFilterWhere([
                    'idRegion' => $this->idRegion,
                    'id_province' => $this->province,
                ]);
        
        $query  ->andFilterWhere(['like', 'houseRating', $this->houseRating])
                ->andFilterWhere(['like', 'services', $this->services])
                ->andFilterWhere(['like', 'facilities', $this->facilities]);
        
        return $dataProvider;
    }
}
