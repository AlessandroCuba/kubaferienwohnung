<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Services;

/**
 * HouseservicesSearch represents the model behind the search form of `common\models\Houseservices`.
 */
class ServicesSearch extends services
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_service'], 'integer'],
            [['Denominations', 'Description', 'foto'], 'safe'],
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
        $query = Services::find();

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
            'id_service' => $this->id_service,
        ]);

        $query->andFilterWhere(['like', 'Denominations', $this->Denominations])
            ->andFilterWhere(['like', 'Description', $this->Description])
            ->andFilterWhere(['like', 'foto', $this->foto]);

        return $dataProvider;
    }
}
