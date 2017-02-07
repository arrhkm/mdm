<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Approval;

use yii\db\Query;
use app\models\Employee;

/**
 * ApprovalSearch represents the model behind the search form about `app\models\Approval`.
 */
class ApprovalSearch extends Approval
{
   
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'level', 'employee_id', 'location_id'], 'integer'],
            [['approval_name', 'first_name', 'location_name'], 'safe'],
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
       // $query = Approval::find();
        //$query2 = New Query();
        //$query= $query2->select('a.*, b.first_name, b.employee_number, c.location_name')
        $query= Approval::find()->select('a.*, b.first_name, c.location_name')->from('approval a')
                ->innerJoinWith('employee b', 'employee.id = approval.employee_id')
                ->innerJoinWith('location c', 'c.id = a.location_id');     
                

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
            'level' => $this->level,
            'employee_id' => $this->employee_id,
            'location_id' => $this->location_id,
            //'b.first_name'=>$this->first_name,
            //'c.location_name'=>$this->location_name,
        ]);

        $query->andFilterWhere([
            'like', 'approval_name', $this->approval_name
            
        ]);
        $query->andFilterWhere(['like', 'b.first_name', $this->first_name]);
        $query->andFilterWhere(['like', 'c.location_name', $this->location_name]);

        return $dataProvider;
    }
}
