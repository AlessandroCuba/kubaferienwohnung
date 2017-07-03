<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\House;

/**
 * HouseSearch represents the model behind the search form of `common\models\House`.
 */
class HouseSearch extends House
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'idRegion', 'idOwner', 'typeReserveId', 'aeropuertoId', 'houseStatus', 'houseFlag', 'houseCreatedAt', 'houseUpdateAt'], 'integer'],
            [['houseName', 'houseDescription', 'houseAdresse', 'houseRating', 'houseFotos', 'price', 'coordenadas'], 'safe'],
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
        $query = House::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'pagination' => false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'idRegion' => $this->idRegion,
            'idOwner' => $this->idOwner,
            'houseStatus' => $this->houseStatus,
            'houseFlag' => $this->houseFlag,
            'houseCreatedAt' => $this->houseCreatedAt,
            'houseUpdateAt' => $this->houseUpdateAt,
            'services' => $this->services,
        ]);

        $query->andFilterWhere(['like', 'houseName', $this->houseName])
            ->andFilterWhere(['like', 'houseDescription', $this->houseDescription])
            ->andFilterWhere(['like', 'houseAdresse', $this->houseAdresse])
            ->andFilterWhere(['like', 'houseRating', $this->houseRating]);

        return $dataProvider;
    }
}
