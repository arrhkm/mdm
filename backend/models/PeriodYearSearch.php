<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PeriodYear;

/**
 * PeriodYearSearch represents the model behind the search form about `app\models\PeriodYear`.
 */
class PeriodYearSearch extends PeriodYear
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'date_day', 'date_month', 'date_year'], 'integer'],
            [['date_start', 'date_end', 'name_period'], 'safe'],
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
        $query = PeriodYear::find();

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
            'id' => $this->id,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'date_day' => $this->date_day,
            'date_month' => $this->date_month,
            'date_year' => $this->date_year,
        ]);

        $query->andFilterWhere(['like', 'name_period', $this->name_period]);

        return $dataProvider;
    }
}
