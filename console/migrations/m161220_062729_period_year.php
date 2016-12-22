<?php

use yii\db\Migration;

class m161220_062729_period_year extends Migration
{
    public function up()
    {
        $this->createTable('period_year',[
            'id'=>$this->primaryKey(),
            'date_start'=>$this->date(),
            'date_end'=>$this->date(),
            'name_period'=>$this->string(255),
            'date_day'=>$this->integer(2),
            'date_month'=>$this->integer(2),
            'date_year'=>$this->integer(2),
        ]);
    }

    public function down()
    {
        $this->dropTable('period_year');
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
