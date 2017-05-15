<?php

/** Singleton class for create single Db instance
 * Class Db
 */
class Db {

	public $host = '127.0.0.1';
	public $user = 'root';
	public $password = 'root';
	public $name = 'smartsport';
	public $charset = 'UTF-8';

	public $_db;
	static $_instance;

	private function __construct() {
		$this->_db = new PDO('mysql:host='.$this->host.';dbname=' .$this->name, $this->user, $this->password);
		$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	/**
	 * @return Db
	 */
	public static function getInstance() {
		if (!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	private function __clone(){}
	private function __wakeup(){}
}