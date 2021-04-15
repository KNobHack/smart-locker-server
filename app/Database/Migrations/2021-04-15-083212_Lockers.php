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
				'constraint' => ['empty', 'occupied'],
				'default'    => 'empty'
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
