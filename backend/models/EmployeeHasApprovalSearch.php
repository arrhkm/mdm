<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EmployeeHasApproval;

class EmployeeHasApprovalSearch extends EmployeeHasApproval
{
     /**
     * @inheritdoc
     */
    public $id_approval;
    public function rules()
    {
        return [
            [['employee_id', 'approval_id'], 'integer'],
            //[['approval_name', 'first_name', 'location_name'], 'safe'],
        ];
    }
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    
    public function search($params, $id_approval)
    {
       // $query = Approval::find();
        //$query2 = New Query();
        //$query= $query2->select('a.*, b.first_name, b.employee_number, c.location_name')
        $query= EmployeeHasApproval::find()
                ->with('approval', 'employee');
                //->from('EmployeeHasApproval');
                //->select('a.*, b.first_name, c.location_name')->from('approval a')
                //->innerJoinWith('Employee b', 'employee.id = a.employee_id')
                //->innerJoinWith('Approvall c', 'c.id = a.approval_id');     
                

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
            'employee_id' => $this->employee_id,
            //'approval_id' => $this->approval_id,
            'approval_id' => $id_approval,
            
            //'employee_id' => $this->employee_id,
            //'location_id' => $this->location_id,
            //'b.first_name'=>$this->first_name,
            //'c.location_name'=>$this->location_name,
        ]);

        //$query->andFilterWhere(['like', 'approval_name', $this->approval_name]);
       

        return $dataProvider;
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

