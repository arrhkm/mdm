<?php

use yii\db\Migration;

class m161204_221851_post2 extends Migration
{
    public function up()
    {
        $tableOptions = null;
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{post2}}', [
            'id' =>$this->primaryKey(),
            'author_id'=>$this->integer()->notNull(),
            'comment'=>$this->text(),
        ], $tableOptions);
              
    }

    public function down()
    {
        echo "m161204_221851_post2 cannot be reverted.\n";

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
