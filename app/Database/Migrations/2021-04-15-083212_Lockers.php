<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Lockers extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type'           => 'CHAR',
				'constraint'     => 8,
			],
			'status' => [
				'type'       => 'ENUM',
				'constraint' => ['Empty', 'Occupied'],
				'default'    => 'Empty'
			],
			'weight' => [
				'type'       => 'INT',
				'default'    => 0,
			],
			'sterilize' => [
				'type'       => 'ENUM',
				'constraint' => ['Unsterilized', 'Sterilizing', 'Sterilized'],
				'default'    => 'Unsterilized'
			],
			'status_lock' => [
				'type'       => 'BOOL',
				'default'    => 0,
			],
			'lock' => [
				'type'       => 'BOOL',
				'default'    => 0,
			],
		]);
		$this->forge->addPrimaryKey('id', true);
		$this->forge->createTable('lockers');
	}

	public function down()
	{
		$this->forge->dropTable('lockers');
	}
}
