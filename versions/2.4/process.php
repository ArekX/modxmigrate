<?php
require __DIR__ . '/../../../core/config/config.inc.php';
$modxPath = realpath(__DIR__ . '/../../../');

$modxConstants = array(
	'MODX_CORE_PATH' => MODX_CORE_PATH,
	'MODX_PROCESSORS_PATH' => MODX_PROCESSORS_PATH,
	'MODX_CONNECTORS_PATH' => MODX_CONNECTORS_PATH,
	'MODX_CONNECTORS_URL' => MODX_CONNECTORS_URL,
	'MODX_MANAGER_PATH' => MODX_MANAGER_PATH,
	'MODX_MANAGER_URL' => MODX_MANAGER_URL,
	'MODX_BASE_PATH' => MODX_BASE_PATH,
	'MODX_BASE_URL' => MODX_BASE_URL,
	'MODX_HTTP_HOST' => MODX_HTTP_HOST,
	'MODX_ASSETS_PATH' => MODX_ASSETS_PATH,
	'MODX_ASSETS_URL' => MODX_ASSETS_URL,
	'MODX_LOG_LEVEL_FATAL' => MODX_LOG_LEVEL_FATAL,
	'MODX_LOG_LEVEL_ERROR' => MODX_LOG_LEVEL_ERROR,
	'MODX_LOG_LEVEL_WARN' => MODX_LOG_LEVEL_WARN,
	'MODX_LOG_LEVEL_INFO' => MODX_LOG_LEVEL_INFO,
	'MODX_LOG_LEVEL_DEBUG' => MODX_LOG_LEVEL_DEBUG,
	'MODX_CACHE_DISABLED' => intval(MODX_CACHE_DISABLED)
);

$disabledConstants = array('MODX_CORE_PATH', 'MODX_PROCESSORS_PATH', 'MODX_CONNECTORS_PATH', 'MODX_MANAGER_PATH', 'MODX_BASE_PATH', 'MODX_ASSETS_PATH');

$fixMap = array(
	"{$modxPath}/config.core.php" => array(
		'fixer' => __DIR__ . '/path_fix.php',
		'fixClass' => 'PathFix',
		'description' => 'Fix path define.'
	),
	"{$modxPath}/connectors/config.core.php" => array(
		'fixer' => __DIR__ . '/path_fix.php',
		'fixClass' => 'PathFix',
		'description' => 'Fix path define.'
	),	
	"{$modxPath}/manager/config.core.php" => array(
		'fixer' => __DIR__ . '/path_fix.php',
		'fixClass' => 'PathFix',
		'description' => 'Fix path define.'
	),
	"{$modxPath}/core/config/config.inc.php" => array(
		'fixer' => __DIR__ . '/config_fix.php',
		'fixClass' => 'ConfigFix',
		'description' => array(
			'Apply new database changes.',
			'Fix path defines.',
			'<strong>Warning</strong>: config.inc.php will be newly generated using data from current config.inc.php. Any custom changes will be discarded.'
		)
	),
	"{$modxPath}/core/cache" => array(
		'fixer' => __DIR__ . '/delete_dir_fix.php',
		'fixClass' => 'DeleteDirFix',
		'description' => 'Remove directory.'
	),
);

if (isset($_POST['migrate'])) {
	unset($_POST['migrate']);

	echo '<pre class="well fix-output">';

	foreach ($fixMap as $fixFile => $config) {
		require_once $config['fixer'];
		$className = $config['fixClass'];

		$instance = new $className(array(
			'file' => $fixFile,
			'additional' => !empty($config['additional']) ? $config['additional'] : array()
		));

		echo "Processsing fix for file {$fixFile}...\n";
		$instance->fix();
		echo "File: {$fixFile} - migration done!\n";
	}

	echo '</pre>';
	exit;
}

if (isset($_GET['iframe'])) {
	echo '<pre>Waiting...</pre>';
	exit;
}