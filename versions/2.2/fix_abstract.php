<?php

abstract class FixAbstract
{
	protected $_config;

	public function __construct($config = array())
	{
		$this->_config = $config;
	}

	public abstract function fix();
}