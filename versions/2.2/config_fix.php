<?php

require_once __DIR__ . '/fix_abstract.php';

class ConfigFix extends FixAbstract
{
	public function fix()
	{
		$basePath = realpath(__DIR__ . '/../../../');
		$corePath = $basePath . '/core/';
		$processorsPath = $basePath . '/core/model/modx/processors/';
		$connectorsPath = $basePath . '/connectors/';
		$managerPath = $basePath . '/manager/';
		$assetsPath = $basePath . '/assets/';

		$cacheDisabled = $_POST['MODX_CACHE_DISABLED'] == '1' ? 'true' : 'false';

		$data = 
<<<DATA
<?php
/**
 *  MODX Configuration file
 */
\$database_type = '{$GLOBALS['database_type']}';
\$database_server = '{$_POST['database_server']}';
\$database_user = '{$_POST['database_user']}';
\$database_password = '{$_POST['database_password']}';
\$database_connection_charset = '{$_POST['database_connection_charset']}';
\$dbase = '{$_POST['dbase']}';
\$table_prefix = '{$_POST['table_prefix']}';
\$database_dsn = '{$_POST['database_dsn']}';
\$config_options = array (
);
\$driver_options = array (
);

\$lastInstallTime = {$GLOBALS['lastInstallTime']};

\$site_id = '{$GLOBALS['site_id']}';
\$site_sessionname = '{$GLOBALS['site_sessionname']}';
\$https_port = '{$GLOBALS['https_port']}';
\$uuid = '{$GLOBALS['uuid']}';

if (!defined('MODX_CORE_PATH')) {
    \$modx_core_path= '{$corePath}';
    define('MODX_CORE_PATH', \$modx_core_path);
}
if (!defined('MODX_PROCESSORS_PATH')) {
    \$modx_processors_path= '{$processorsPath}';
    define('MODX_PROCESSORS_PATH', \$modx_processors_path);
}
if (!defined('MODX_CONNECTORS_PATH')) {
    \$modx_connectors_path= '{$connectorsPath}';
    \$modx_connectors_url= '{$_POST['MODX_CONNECTORS_URL']}';
    define('MODX_CONNECTORS_PATH', \$modx_connectors_path);
    define('MODX_CONNECTORS_URL', \$modx_connectors_url);
}
if (!defined('MODX_MANAGER_PATH')) {
    \$modx_manager_path= '{$managerPath}';
    \$modx_manager_url= '{$_POST['MODX_MANAGER_URL']}';
    define('MODX_MANAGER_PATH', \$modx_manager_path);
    define('MODX_MANAGER_URL', \$modx_manager_url);
}
if (!defined('MODX_BASE_PATH')) {
    \$modx_base_path= '{$basePath}/';
    \$modx_base_url= '{$_POST['MODX_BASE_URL']}';
    define('MODX_BASE_PATH', \$modx_base_path);
    define('MODX_BASE_URL', \$modx_base_url);
}
if(defined('PHP_SAPI') && (PHP_SAPI == "cli" || PHP_SAPI == "embed")) {
    \$isSecureRequest = false;
} else {
    \$isSecureRequest = ((isset (\$_SERVER['HTTPS']) && strtolower(\$_SERVER['HTTPS']) == 'on') || \$_SERVER['SERVER_PORT'] == \$https_port);
}
if (!defined('MODX_URL_SCHEME')) {
    \$url_scheme=  \$isSecureRequest ? 'https://' : 'http://';
    define('MODX_URL_SCHEME', \$url_scheme);
}
if (!defined('MODX_HTTP_HOST')) {
    if(defined('PHP_SAPI') && (PHP_SAPI == "cli" || PHP_SAPI == "embed")) {
        \$http_host='localhost';
        define('MODX_HTTP_HOST', \$http_host);
    } else {
        \$http_host= array_key_exists('HTTP_HOST', \$_SERVER) ? \$_SERVER['HTTP_HOST'] : 'localhost';
        if (\$_SERVER['SERVER_PORT'] != 80) {
            \$http_host= str_replace(':' . \$_SERVER['SERVER_PORT'], '', \$http_host); // remove port from HTTP_HOST
        }
        \$http_host .= (\$_SERVER['SERVER_PORT'] == 80 || \$isSecureRequest) ? '' : ':' . \$_SERVER['SERVER_PORT'];
        define('MODX_HTTP_HOST', \$http_host);
    }
}
if (!defined('MODX_SITE_URL')) {
    \$site_url= \$url_scheme . \$http_host . MODX_BASE_URL;
    define('MODX_SITE_URL', \$site_url);
}
if (!defined('MODX_ASSETS_PATH')) {
    \$modx_assets_path= '{$assetsPath}';
    \$modx_assets_url= '{$_POST['MODX_ASSETS_URL']}';
    define('MODX_ASSETS_PATH', \$modx_assets_path);
    define('MODX_ASSETS_URL', \$modx_assets_url);
}
if (!defined('MODX_LOG_LEVEL_FATAL')) {
    define('MODX_LOG_LEVEL_FATAL', {$_POST['MODX_LOG_LEVEL_FATAL']});
    define('MODX_LOG_LEVEL_ERROR', {$_POST['MODX_LOG_LEVEL_ERROR']});
    define('MODX_LOG_LEVEL_WARN', {$_POST['MODX_LOG_LEVEL_WARN']});
    define('MODX_LOG_LEVEL_INFO', {$_POST['MODX_LOG_LEVEL_INFO']});
    define('MODX_LOG_LEVEL_DEBUG', {$_POST['MODX_LOG_LEVEL_DEBUG']});
}
if (!defined('MODX_CACHE_DISABLED')) {
    \$modx_cache_disabled= {$cacheDisabled};
    define('MODX_CACHE_DISABLED', \$modx_cache_disabled);
}
DATA;
		file_put_contents($this->_config['file'], $data);
	}
}