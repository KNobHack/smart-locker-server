<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Occupy extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'user_id' => [
				'type'       => 'INT',
				'unsigned'       => true,
				'constraint' => 11,
			],
			'locker_id' => [
				'type'       => 'CHAR',
				'constraint' => 8,
			]
		]);
		$this->forge->addForeignKey('user_id', 'users', 'id');
		$this->forge->addForeignKey('locker_id', 'lockers', 'id');
		$this->forge->addPrimaryKey('id');
		$this->forge->createTable('occupy');
	}

	public function down()
	{
		$this->forge->dropTable('occupy');
	}
}
