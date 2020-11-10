<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTableComments extends AbstractMigration
{
    public function up(){
        $comments = $this->table('comments');
        $comments->addColumn('author_id', 'integer', [])
        ->addColumn('content', 'string',['limit' => 255] )
        ->addColumn('message_id', 'integer',[] )
        ->addForeignKey('author_id', 'users', 'id', ['delete'=> 'RESTRICT', 'update'=> 'CASCADE'])
        ->addForeignKey('message_id', 'messages', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE']);
        $comments->save();
   }
   public function down(){
        $this->dropTable('comments');
   }  
}
