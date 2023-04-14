<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreDelTrx extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $trx_users = $this->table('trx_users');
        $trx_users->addColumn('user_name', 'string', ['limit' => 20])
                  ->addColumn('password',  'string', ['limit' => 255])
                  ->create();

        $trx_comments = $this->table('trx_comments');
        $trx_comments->addColumn('user_id', 'integer', ['signed' => false, 'null' => false])
                     //->integer('user_id')->unsigned()
                     ->addColumn('text',    'string',     ['limit' => 255])
                     ->addForeignKey('user_id', 'trx_users', 'id', ['delete'=>'NO_ACTION', 'update'=>'NO_ACTION'])
                     ->create();

    }
}
