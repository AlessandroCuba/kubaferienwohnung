<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Booking;

/**
 * BookingSearch represents the model behind the search form of `common\models\Booking`.
 */
class BookingSearch extends Booking
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_booking', 'idUser', 'idHouse', 'PersonenNo', 'idstatus'], 'integer'],
            [['created_at', 'updated_at', 'CheckInDate', 'CheckOutDate'], 'safe'],
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
        $query = Booking::find();

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
            'id_booking' => $this->id_booking,
            'idUser' => $this->idUser,
            'idHouse' => $this->idHouse,
            'CheckInDate' => $this->CheckInDate,
            'CheckOutDate' => $this->CheckOutDate,
            'PersonenNo' => $this->PersonenNo,
            'idstatus' => $this->idstatus,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
