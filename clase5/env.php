<?php
if (!defined('BASE_URL')) {
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
    if (substr($scriptDir, -6) === '/pages') {
        $base = substr($scriptDir, 0, -6);
    } else {
        $base = $scriptDir;
    }
    $base = rtrim($base, '/') . '/';
    define('BASE_URL', $base);
}
define('APP_ENV', 'local');
define('APP_NAME', 'NodeSite');
define('APP_EMAIL', 'soporte@nodesite.com');
define('APP_AUTHOR', 'Jose');
