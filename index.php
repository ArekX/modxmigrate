<?php
$versionDataFilePath = __DIR__ . '/../core/docs/version.inc.php';

if (!file_exists($versionDataFilePath)) {
	echo '<h1>Version file not found!</h1>';
	echo '<div>Please put this script into a separate folder in the root of your MODx project.</div>';
	echo '<div>Also check that your MODx version is supported by this site migration script in the versions folder.</div>';
	die;
}

$versionData = require $versionDataFilePath;

$majorVersion = $versionData['version'] . '.' . $versionData['major_version'];
$fullVersion = $versionData['version'] . '.' . $versionData['major_version'] . '.' . $versionData['minor_version'];
$modxFullVersion = $versionData['full_version'];

ob_start();
$modxFullVerTemplate = __DIR__ . "/versions/{$modxFullVersion}/form.php";
$fullVerTemplate = __DIR__ . "/versions/{$fullVersion}/form.php";
$majorVerTemplate = __DIR__ . "/versions/{$majorVersion}/form.php";

if (file_exists($modxFullVerTemplate)) {
    require_once $modxFullVerTemplate;
} else if (file_exists($fullVerTemplate)) {
	require_once $fullVerTemplate;
} else if (file_exists($majorVerTemplate)) {
	require_once $majorVerTemplate;
} else {
	echo 'Error! Your version of MODx Revolution is not supported!';
}
$content = ob_get_clean();

require 'layout.php';