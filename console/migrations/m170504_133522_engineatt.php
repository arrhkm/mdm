<?php

use yii\db\Migration;

class m170504_133522_engineatt extends Migration
{
    public function up()
    {
        $this->createTable('enggineatt', [
            'id'=>$this->primaryKey(11),
            'pin'=>$this->integer(11)->notNull(),
            'dateatt'=>$this->dateTime(),
            'verified'=>$this->integer(1),
            'status'=>$this->integer(),
        ]);
    }

    public function down()
    {
        echo "m170504_133522_engineatt cannot be reverted.\n";

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
