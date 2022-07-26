<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%like}}`.
 */
class m220725_101526_create_like_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%like}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(10)->notNull(),
            'comment_id' => $this->integer(10)->notNull(),
            'status' => $this->tinyInteger(2)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%like}}');
    }
}
