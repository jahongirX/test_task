<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m220725_101443_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'body' => $this->string()->notNull(),
            'create_date' => $this->dateTime()->defaultExpression("NOW()"),
            'status' => $this->tinyInteger(2)->defaultValue(1)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comment}}');
    }
}
