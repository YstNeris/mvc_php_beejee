<?php

namespace app\models;

use app\core\Model;

class Account extends Model
{
	public function find($login, $password)
	{
		return $this->db->fetch("SELECT * FROM `user` WHERE `login` = ? AND `password` = ?", [@$login, @$password]);
	}
}
