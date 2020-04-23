<?php

namespace app\models;

use app\core\Model;

class Home extends Model
{
	public function getTasks($page = 1, $limit = 3, $ORDER = "ASC", $SORT = "id")
	{
		$offset = ($page - 1) * $limit;
		return $this->db->row("SELECT * FROM `task` ORDER BY $SORT $ORDER LIMIT ?, ?", [$offset, $limit]);
	}
	public function getTaskCount()
	{
		$res = $this->db->row("SELECT count(*) FROM `task`");
		return $res ? $res[0]['count(*)'] : 0;
	}

	public function addAdmin()
	{
		return $this->db->query("INSERT OR IGNORE INTO `user` (`login`, `password`, `admin`) VALUES (?, ?, ?)", ['admin', '123', true]);
	}
}
