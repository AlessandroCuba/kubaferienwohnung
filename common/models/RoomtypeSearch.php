<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Roomtype;

/**
 * RoomtypeSearch represents the model behind the search form of `common\models\Roomtype`.
 */
class RoomtypeSearch extends Roomtype
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idroomtype'], 'integer'],
            [['typeRoom', 'typeDesc'], 'safe'],
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
        $query = Roomtype::find();

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
            'idroomtype' => $this->idroomtype,
        ]);

        $query->andFilterWhere(['like', 'typeRoom', $this->typeRoom])
            ->andFilterWhere(['like', 'typeDesc', $this->typeDesc]);

        return $dataProvider;
    }
}
