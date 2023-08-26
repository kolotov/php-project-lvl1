<?php

$autoloadGlobalPath = __DIR__ . '/../../../autoload.php';
$autoloadLocalPath = __DIR__ . '/../vendor/autoload.php';

$autoloadPath = file_exists($autoloadGlobalPath) ? $autoloadGlobalPath : $autoloadLocalPath;

require_once $autoloadPath;
