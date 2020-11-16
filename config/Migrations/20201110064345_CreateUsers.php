<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

class CreateUsers extends AbstractMigration
{
  public function up(){
        $users = $this->table('users');
        $users->addColumn('name', 'string', [])
        ->addIndex(['name'], ['unique' => true]);
        $users->save();
   }
   public function down(){
        $this->dropTable('users');
   }  
}
