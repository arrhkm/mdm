<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LeaveEntitlement;

use yii\db\Query;
use app\models\LeaveType;

/**
 * LeaveEntitlementSearch represents the model behind the search form about `app\models\LeaveEntitlement`.
 */
class LeaveEntitlementSearch extends LeaveEntitlement
{
    /**
     * @inheritdoc
     */
    //public $first_name;
    //public $name_type; 

    public function rules()
    {
        return [
            [['id', 'deleted', 'employee_id', 'leave_type_id', 'user_id'], 'integer'],
            [['no_of_days', 'days_used'], 'number'],
            [['from_date', 'to_date', 'credited_date', 'note', 
                'createed_by_name', 'first_name', 'name_type',
               
             ], 
             'safe'
            ],
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
       
        //$query = LeaveEntitlement::find();        
        
        $query = LeaveEntitlement::find()->with('leaveType', 'employee')// untuk mengabil fungsi relasi
                //->select('a.*, b.first_name, c.name_type')
                ->from('leave_entitlement a')              
                ->innerJoin('employee b', 'b.id = a.employee_id')//untuk fungsi searching query 
                ->innerJoin('leave_type c', 'c.id=a.leave_type_id');//untuk fungsi searching query 
                
        
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
            ->andFilterWhere(['like', 'createed_by_name', $this->createed_by_name])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'name_type', $this->name_type]);

        return $dataProvider;
    }
}
