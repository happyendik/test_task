<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m181130_092309_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'nickname' => $this->string(),
            'name' => $this->string(),
            'surname' => $this->string(),
            'email' => $this->string(),
            'password' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }
}
