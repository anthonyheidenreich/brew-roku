<?php
class Mysql
{
	private $_db;
	protected $_table;
	protected $_primary_key = 'uid';

	public function __construct($config) {
		$this->_db = new mysqli($config['host'], $config['user'], $config['password'], $config['database'], $config['port']);
		if ($this->_db->connect_error) {
			throw new Exception(sprintf('Database Error: %s (%s)', $this->_db->connect_error, $this->_db->connect_errno));
		}
	}

	public function escape($var) {
		return $this->_db->real_escape_string($var);
	}

	public function get($uid) {
		$result = $this->query(sprintf('select * from %s where %s = "%s"', $this->_table, $this->_primary_key, $this->escape($uid)));
		return $result->fetch_assoc();
	}

	public function all() {
		$result = [];
		$r = $this->query(sprintf('select * from %s', $this->_table));
		while ($row = $r->fetch_assoc()) {
			$result[] = $row;
		}
		return $result;
	}

	public function query($sql) {
		return $this->_db->query($sql);
	}

	public function __destruct() {
		$this->_db->close();
	}

	public function save($data) {
		if (array_key_exists($this->_primary_key, $data)) {
			return $this->update($data);
		} else {
			return $this->insert($data);
		}
	}

	protected function _generate_pk() {
		return uuid();
	}

	public function delete($uid) {
		$result = $this->query(sprintf('delete from %s where %s = "%s"', $this->_table, $this->_primary_key, $this->escape($uid)));
	}

	public function insert($data) {
		$keys = [$this->_primary_key];
		$values = [$this->_generate_pk()];
		foreach ($data as $k => $v) {
			$keys[] = $k;
			$values[] = $this->escape($v);
		}
		$sql = sprintf('insert into %s (%s) values ("%s")', $this->_table, implode(',', $keys), implode('", "',$values));;
		# debug($sql);
		return $this->query($sql);
	}

	public function update($data) {
		$pk = null;
		$values = [];
		foreach ($data as $k=>$v) { 
			if ($k == $this->_primary_key) {
				$pk = $this->escape($v);
			} else {
				$values[] = sprintf('%s = "%s"', $k, $this->escape($v));
			}
		}
		$sql = sprintf('update %s set %s where %s = "%s"', $this->_table, implode(',', $values), $this->_primary_key, $pk);
		# debug($sql);
		return $this->query($sql);
	}
}

class Brew extends Mysql
{
	protected $_table = 'brew';

	public $brews =  [
		'On Tap' => [],
		'In the Works' => [],
		'Out of Stock' => [],
	];

	public function grouped() {
		array_map(function($brew) { $this->brews[$brew['status']][] = $brew; }, $this->all());
		return $this->brews;
	}
}
