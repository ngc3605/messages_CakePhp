<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTableMessage extends AbstractMigration
{
   public function up(){
    $messages = $this->table('messages');
    $messages->addColumn('title', 'string', ['limit' => 255])
    ->addColumn('preview', 'text',[] )
    ->addColumn('content', 'text',[] )
    ->addColumn('author_id', 'integer',[] )
    ->addForeignKey('author_id', 'users', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE']);;
    $messages->save();
   }
   public function down(){
    $this->dropTable('messages');
   }    
}
