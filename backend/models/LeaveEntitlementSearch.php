<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LeaveEntitlement;

/**
 * LeaveEntitlementSearch represents the model behind the search form about `app\models\LeaveEntitlement`.
 */
class LeaveEntitlementSearch extends LeaveEntitlement
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'deleted', 'employee_id', 'leave_type_id', 'user_id'], 'integer'],
            [['no_of_days', 'days_used'], 'number'],
            [['from_date', 'to_date', 'credited_date', 'note', 'createed_by_name'], 'safe'],
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
        $query = LeaveEntitlement::find();

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
            'no_of_days' => $this->no_of_days,
            'days_used' => $this->days_used,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'credited_date' => $this->credited_date,
            'deleted' => $this->deleted,
            'employee_id' => $this->employee_id,
            'leave_type_id' => $this->leave_type_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'createed_by_name', $this->createed_by_name]);

        return $dataProvider;
    }
}
