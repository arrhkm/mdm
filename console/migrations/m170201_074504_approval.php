<?php

use yii\db\Migration;

class m170201_074504_approval extends Migration
{
    public function up()
    {
      
        $this->createTable('approval', [
            'id'=>$this->primaryKey(11),
            'approval_name'=>$this->string(45),
            'level'=>$this->smallInteger(6)->notNull()->unique(),
            'employee_id'=>$this->integer(11),
            'location_id'=>$this->smallInteger(),
        ]);
        // add index 
        $this->createIndex('idx-approval-employee_id', 'approval', 'employee_id');
        $this->createIndex('idx_approval_location_id1', 'approval', 'location_id');
        
        
        $this->addForeignKey(
            'fk_approval_employee_id1', 
            'approval', 
            'employee_id', 
            'employee', 
            'id', 
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk_approval_location1', 
            'approval', 
            'location_id', 
            'location', 
            'id'
        );
        
        

    
    }


    public function down()
    {
        echo "m170201_074504_approval cannot be reverted.\n";

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
