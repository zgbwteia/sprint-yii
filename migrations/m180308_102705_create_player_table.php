<?php

use yii\db\Migration;

/**
 * Handles the creation of table `player`.
 * Has foreign keys to the tables:
 *
 * - `campaign`
 */
class m180308_102705_create_player_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('player', [
            'id' => $this->primaryKey(),
            'campaign_id' => $this->integer(),
            'login' => $this->string(255)->notNull(),
            'name' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'phone' => $this->string(15)->notNull(),
            'sex' => $this->integer()->notNull(),
            'birthday' => $this->datetime(),
            'score' => $this->integer()->notNull()->defaultValue(0),
            'coins' => $this->integer()->notNull()->defaultValue(0),
            'system' => $this->json()->notNull()->defaultValue([]),
            'last_day' => $this->datetime(),
            'created_at' => $this->datetime()->notNull(),
        ]);

        // creates index for column `campaign_id`
        $this->createIndex(
            'idx-player-campaign_id',
            'player',
            'campaign_id'
        );

        // add foreign key for table `campaign`
        $this->addForeignKey(
            'fk-player-campaign_id',
            'player',
            'campaign_id',
            'campaign',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `campaign`
        $this->dropForeignKey(
            'fk-player-campaign_id',
            'player'
        );

        // drops index for column `campaign_id`
        $this->dropIndex(
            'idx-player-campaign_id',
            'player'
        );

        $this->dropTable('player');
    }
}
