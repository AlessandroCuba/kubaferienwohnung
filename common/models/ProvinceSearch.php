<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Province;

/**
 * ProvinceSearch represents the model behind the search form of `common\models\Province`.
 */
class ProvinceSearch extends Province
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_province'], 'integer'],
            [['provinceName', 'provinceCode'], 'safe'],
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
        $query = Province::find();

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
            'id_province' => $this->id_province,
        ]);

        $query->andFilterWhere(['like', 'provinceName', $this->provinceName])
            ->andFilterWhere(['like', 'provinceCode', $this->provinceCode]);

        return $dataProvider;
    }
}
