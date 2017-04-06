<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Leave;

/**
 * LeaveSearch represents the model behind the search form about `app\models\Leave`.
 */
class LeaveSearch extends Leave
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'leave_request_id', 'leave_type_id', 'employee_id'], 'integer'],
            [['date', 'start_time', 'end_time', 'status'], 'safe'],
            [['lenght_days', 'lenght_hours'], 'number'],
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
        $query = Leave::find();

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
            'date' => $this->date,
            'lenght_days' => $this->lenght_days,
            'lenght_hours' => $this->lenght_hours,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'leave_request_id' => $this->leave_request_id,
            'leave_type_id' => $this->leave_type_id,
            'employee_id' => $this->employee_id,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
    public function search2($employee_id)
    {
        $query = Leave::find();
        $dataProvider = new ActiveDataProvider([
           'query'=>$query, 
        ]);
        //$this->load($params);
        if (!$this->validate()){
            return $dataProvider;
        }
        $query->andFilterWhere([
            'employee_id'=>$employee_id,
        ]);
        return $dataProvider;
    }
}
