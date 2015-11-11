<?php

abstract class FixAbstract
{
	protected $_config;

	public function __construct($config = [])
	{
		$this->_config = $config;
	}

	public abstract function fix();
}