<?php

namespace app\core;

use app\libs\DB;

abstract class Model
{

	public $db;

	public function __construct()
	{
		$this->db = new DB;
	}
}
