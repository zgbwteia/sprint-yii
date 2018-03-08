<?php

use yii\db\Migration;

/**
 * Handles the creation of table `campaign_type`.
 * Has foreign keys to the tables:
 *
 * - `campaign_status`
 */
class m180308_101739_create_campaign_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('campaign_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'campaign_status_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('NOW()'),
        ]);

        // creates index for column `campaign_status_id`
        $this->createIndex(
            'idx-campaign_type-campaign_status_id',
            'campaign_type',
            'campaign_status_id'
        );

        // add foreign key for table `campaign_status`
        $this->addForeignKey(
            'fk-campaign_type-campaign_status_id',
            'campaign_type',
            'campaign_status_id',
            'campaign_status',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `campaign_status`
        $this->dropForeignKey(
            'fk-campaign_type-campaign_status_id',
            'campaign_type'
        );

        // drops index for column `campaign_status_id`
        $this->dropIndex(
            'idx-campaign_type-campaign_status_id',
            'campaign_type'
        );

        $this->dropTable('campaign_type');
    }
}
