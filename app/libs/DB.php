<?php

namespace app\libs;

use PDO;

class DB
{

	protected $db;

	public function __construct()
	{
		// $this->db = new PDO('mysql:host=localhost;dbname=mvc', 'root', '');
		$path = __DIR__ . '/../database/db.sqlite3';
		$migrationsPath = __DIR__ . '/../database/migrations/';

		$this->db = new PDO("sqlite:$path");

		if (!file_exists($path) || !filesize($path)) {
			session_destroy();
			$dir = scandir($migrationsPath);
			$dir = array_splice($dir, -2);
			foreach ($dir as $name) {
				$columns = require_once $migrationsPath . $name;
				$query = 'CREATE TABLE IF NOT EXISTS ' . mb_substr($name, 0, -4) . ' (';
				foreach ($columns as $column) $query .= $column . ', ';
				$query = mb_substr($query, 0, -2) . ')';
				$row = $this->db->exec($query);
			}
		}
	}

	public function query($sql, $params = [])
	{
		$res = $this->db->prepare($sql);
		if ($res && $params) {
			if (is_int(array_keys($params)[0])) $res->execute($params);
			else {
				foreach ($params as $key => $value) $res->bindValue(':' . $key, $value);
				$res->execute();
			}
		} else $res = $this->db->query($sql);
		return $res;
	}

	public function fetch($sql, $params = [])
	{
		$result = $this->query($sql, $params);
		return $result->fetch(PDO::FETCH_ASSOC);
	}

	public function row($sql, $params = [])
	{
		$result = $this->query($sql, $params);
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	public function column($sql, $params = [])
	{
		$result = $this->query($sql, $params);
		return $result->fetchColumn(PDO::FETCH_ASSOC);
	}
}
