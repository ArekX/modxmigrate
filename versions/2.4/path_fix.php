<?php

require_once __DIR__ . '/fix_abstract.php';

class PathFix extends FixAbstract
{
	public function fix()
	{
		$fileContents = file_get_contents($this->_config['file']);
		$corePath = realpath(__DIR__ . '/../../../core');

		$fileContents = preg_replace("/define\(\'MODX_CORE_PATH\',\s*\'(.+)\'\);/", "define('MODX_CORE_PATH','{$corePath}');", $fileContents);

		file_put_contents($this->_config['file'], $fileContents);
	}
}