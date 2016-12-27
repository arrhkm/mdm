<?php

use yii\db\Migration;

class m161220_031146_employee extends Migration
{
    public function up()
    {
        $this->createTable ('employee', [
            'id'=>$this->primaryKey(),
            'employee_number'=>$this->string(20)->notNull()->unique(),
            'first_name'=>$this->string(255),
            'midle_name'=>$this->string(255),
            'last_name'=>$this->string(255), 
            'nick_name'=>$this->string(255),
        ]);
    }

    public function down()
    {
        $this->dropTable('employee');
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
