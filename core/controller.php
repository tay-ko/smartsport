<?php

/**
 * Base controller
 * Class Controller
 */
class Controller {

	public $view;
	public $instance;
	public $db;

	function __construct()
	{
		$this->view = new View();
		$this->instance = Db::getInstance();
		$this->db = $this->instance->_db;
	}

	function action_index()
	{
	}
}