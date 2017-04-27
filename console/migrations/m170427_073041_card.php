<?php

use yii\db\Migration;

class m170427_073041_card extends Migration
{
    public function up()
    {
        $this->createTable('card', [
           'id'=>$this->primaryKey(11),
            'employee_id'=>$this->integer(11)->notNull()->unique(),
            'create_date'=>$this->dateTime()
            
        ]);
        
        $this->createIndex('idx_employee_id1', 'card', 'employee_id');
        $this->addForeignKey(
            'fk_employee_id1', 
            'card', 
            'employee_id', 
            'employee', 
            'id', 
            'CASCADE', 
            'CASCADE'
        );
        
    }

    public function down()
    {
        echo "m170427_073041_card cannot be reverted.\n";

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
