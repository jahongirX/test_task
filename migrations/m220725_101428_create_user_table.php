<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m220725_101428_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull(),
            'password' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'avatar' => $this->string(255)->null(),
            'status' => $this->tinyInteger(2)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
