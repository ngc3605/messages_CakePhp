<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class Initial extends AbstractMigration
{
    /**
     * Up Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-up-method
     * @return void
     */
    public function up()
    {
        $this->table('comments')
            ->addColumn('author_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('content', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('message_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'message_id',
                ]
            )
            ->addIndex(
                [
                    'author_id',
                ]
            )
            ->create();

        $this->table('messages')
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('preview', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('content', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('author_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'author_id',
                ]
            )
            ->create();

        $this->table('users')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addIndex(
                [
                    'name',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('comments')
            ->addForeignKey(
                'message_id',
                'messages',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE',
                ]
            )
            ->addForeignKey(
                'author_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'RESTRICT',
                ]
            )
            ->update();

        $this->table('messages')
            ->addForeignKey(
                'author_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE',
                ]
            )
            ->update();
    }

    /**
     * Down Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-down-method
     * @return void
     */
    public function down()
    {
        $this->table('comments')
            ->dropForeignKey(
                'message_id'
            )
            ->dropForeignKey(
                'author_id'
            )->save();

        $this->table('messages')
            ->dropForeignKey(
                'author_id'
            )->save();

        $this->table('comments')->drop()->save();
        $this->table('messages')->drop()->save();
        $this->table('users')->drop()->save();
    }
}
