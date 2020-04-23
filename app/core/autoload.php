<?php

declare(strict_types=1);

use app\core\App;

session_start();
spl_autoload_register(function ($class) {
	$path = str_replace('\\', '/', $class . '.php');
	if (file_exists($path)) require $path;
});

$app = new App();
