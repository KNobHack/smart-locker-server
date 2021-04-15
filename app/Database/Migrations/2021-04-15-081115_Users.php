<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
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
			'username' => [
				'type'       => 'VARCHAR',
				'constraint' => '128',
				'unique'     => true,
			],
			'password' => [
				'type'       => 'VARCHAR',
				'constraint' => 255,
			],
			'created_at' => [
				'type' => 'datetime',
			],
			'updated_at' => [
				'type' => 'datetime',
			],
			'deleted_at' => [
				'type' => 'datetime',
			],
		]);
		$this->forge->addPrimaryKey('id', true);
		$this->forge->createTable('users');
	}

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
