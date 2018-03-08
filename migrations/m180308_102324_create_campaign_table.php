<?php

use yii\db\Migration;

/**
 * Handles the creation of table `campaign`.
 * Has foreign keys to the tables:
 *
 * - `member`
 * - `campaign_type`
 */
class m180308_102324_create_campaign_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('campaign', [
            'id' => $this->primaryKey(),
            'member_id' => $this->integer(),
            'campaign_type_id' => $this->integer(),
            'name' => $this->string(255)->notNull(),
            'login_type' => $this->integer()->notNull(),
            'custom_setting' => $this->text(),
            'message_end' => $this->text(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('NOW()'),
        ]);

        // creates index for column `member_id`
        $this->createIndex(
            'idx-campaign-member_id',
            'campaign',
            'member_id'
        );

        // add foreign key for table `member`
        $this->addForeignKey(
            'fk-campaign-member_id',
            'campaign',
            'member_id',
            'member',
            'id',
            'CASCADE'
        );

        // creates index for column `campaign_type_id`
        $this->createIndex(
            'idx-campaign-campaign_type_id',
            'campaign',
            'campaign_type_id'
        );

        // add foreign key for table `campaign_type`
        $this->addForeignKey(
            'fk-campaign-campaign_type_id',
            'campaign',
            'campaign_type_id',
            'campaign_type',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `member`
        $this->dropForeignKey(
            'fk-campaign-member_id',
            'campaign'
        );

        // drops index for column `member_id`
        $this->dropIndex(
            'idx-campaign-member_id',
            'campaign'
        );

        // drops foreign key for table `campaign_type`
        $this->dropForeignKey(
            'fk-campaign-campaign_type_id',
            'campaign'
        );

        // drops index for column `campaign_type_id`
        $this->dropIndex(
            'idx-campaign-campaign_type_id',
            'campaign'
        );

        $this->dropTable('campaign');
    }
}
