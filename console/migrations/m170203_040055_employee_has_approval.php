<?php

use yii\db\Migration;

class m170203_040055_employee_has_approval extends Migration
{
    public function up()
    {
        $this->createTable('employee_has_approval', [
            'employee_id'=>$this->integer(11),
            'approval_id'=>$this->integer(11),
            'PRIMARY KEY (employee_id, approval_id)'
        ]);
       
        //$this->createIndex('idx_employee_id1', 'employee_has_approval', 'employee_id');
        //$this->createIndex('idx_approval_id1', 'employee_has_approval', 'approval_id');
       // $this->addPrimaryKey('employee_has_approval_pk', 'employee_has_approval', ['employee_id', 'approval_id']);
        $this->addForeignKey(
                'fk_employee_has_approval_employee1_idx', 
                'employee_has_approval', 
                'employee_id', 
                'employee', 
                'id',
                'CASCADE', 
                'CASCADE'
        );
        
        $this->addForeignKey(
                'fk_employee_has_approval_approval1_idx', 
                'employee_has_approval', 
                'approval_id', 
                'approval', 
                'id',
                'CASCADE', 'CASCADE'
        );
        //$this->addPrimaryKey('employee_has_approval_pk', 'employee_has_approval', ['employee_id', 'approval_id']);
        
    }

    public function down()
    {
        echo "m170203_040055_employee_has_approvall cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
