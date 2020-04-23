<?php

namespace app\models;

use app\core\Model;

class Task extends Model
{
	public function add($data = [])
	{
		extract($data);
		return $this->db->query("INSERT INTO `task` (`name`, `email`, `content`, `done`, `edited`) VALUES (?, ?, ?, ?, ?)", [$name, $email, $content, @$done, @$edited]);
	}

	public function get($id)
	{
		return $this->db->fetch("SELECT * FROM task WHERE id = ?", [$id]);
	}

	public function update($data = [])
	{
		extract($data);
		return $this->db->fetch("UPDATE task SET content = ?, done = ?, edited = ? WHERE id = ?", [$content, @$done, $content != $oldContent ? true : false, $id]);
	}
}
