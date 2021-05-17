<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\Occupy;

class Lockers extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'lockers';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = false;
	protected $insertID             = 0;
	protected $returnType           = 'App\Entities\Locker';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['status', 'weight', 'sterilize', 'status_lock', 'lock'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	public static function occupied($id): bool
	{
		return !!(new Lockers())->find($id)->countAllResults();
	}

	public function privateLockers()
	{
		$user_id = session('credential')['id'];
		$occupy = new Occupy();

		return $occupy
			->select("{$this->table}.*")
			->join($this->table, "{$this->table}.{$this->primaryKey} = {$occupy->table}.locker_id")
			->where(["{$occupy->table}.user_id" => $user_id])
			// ->get()->getCustomResultObject('App\Entities\Locker');
			->findAll();
	}
}
