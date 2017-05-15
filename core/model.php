<?php

/**
 * Class Model
 * @var $connect
 */
class Model
{
	/** @var $connect Db */
	public $connect;

	public function __construct($connect)
	{
		$this->connect = $connect;
	}

	public function get_data()
	{
	}
}