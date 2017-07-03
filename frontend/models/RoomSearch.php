<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Room;

/**
 * RoomSearch represents the model behind the search form of `common\models\Room`.
 */
class RoomSearch extends Room
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idroom', 'idhouse', 'id_type', 'roomCapacity', 'roomPrice', 'roomStatus', 'created_at', 'updated_at'], 'integer'],
            [['Description', 'roomfacilities'], 'safe'],
            [['roomDimension'], 'number'],
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
        $query = Room::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idroom' => $this->idroom,
            'idhouse' => $this->idhouse,
            'id_type' => $this->id_type,
            'roomCapacity' => $this->roomCapacity,
            'roomDimension' => $this->roomDimension,
            'roomPrice' => $this->roomPrice,
            'roomStatus' => $this->roomStatus,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'Description', $this->Description])
            ->andFilterWhere(['like', 'roomfacilities', $this->roomfacilities]);

        return $dataProvider;
    }
}
