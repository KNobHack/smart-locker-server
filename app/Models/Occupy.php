<?php

namespace App\Models;

use CodeIgniter\Model;

class Occupy extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'occupies';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [];

	// Dates
	protected $useTimestamps        = true;
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

	public static function attach($user_id, $locker_id)
	{
		$count = (new Occupy())
			->where([
				'user_id' => $user_id,
				'locker_id' => $locker_id
			])->countAll();
		if ($count > 1) return;

		(new Occupy())
			->insert([
				'user_id' => $user_id,
				'locker_id' => $locker_id
			]);
	}

	public function detach($user_id, $locker_id)
	{
		(new Occupy())
			->where([
				'user_id' => $user_id,
				'locker_id' => $locker_id
			])->delete();
	}
}
