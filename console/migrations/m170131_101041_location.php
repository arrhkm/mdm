<?php

use yii\db\Migration;

class m170131_101041_location extends Migration
{
    public function up()
    {
        $this->createTable('location', [
            'id'=>$this->primaryKey(),
            'location_name'=>$this->string(),
        ]);
    }

    public function down()
    {
       $this->dropTable('location');

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
