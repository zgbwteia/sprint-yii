<?php

use yii\db\Migration;

/**
 * Handles the creation of table `member`.
 * Has foreign keys to the tables:
 *
 * - `member_type`
 */
class m180308_102134_create_member_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('member', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'phone' => $this->string(15)->notNull(),
            'password' => $this->string(20)->notNull(),
            'system_field' => $this->json()->notNull()->defaultValue('[]'),
            'member_type_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('NOW()'),
        ]);

        // creates index for column `member_type_id`
        $this->createIndex(
            'idx-member-member_type_id',
            'member',
            'member_type_id'
        );

        // add foreign key for table `member_type`
        $this->addForeignKey(
            'fk-member-member_type_id',
            'member',
            'member_type_id',
            'member_type',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `member_type`
        $this->dropForeignKey(
            'fk-member-member_type_id',
            'member'
        );

        // drops index for column `member_type_id`
        $this->dropIndex(
            'idx-member-member_type_id',
            'member'
        );

        $this->dropTable('member');
    }
}
