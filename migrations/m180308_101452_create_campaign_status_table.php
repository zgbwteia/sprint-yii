<?php

use yii\db\Migration;

/**
 * Handles the creation of table `campaign_status`.
 */
class m180308_101452_create_campaign_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('campaign_status', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'created_at' => $this->datetime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('campaign_status');
    }
}
