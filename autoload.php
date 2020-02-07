<?php
require_once 'vendor/autoload.php';

spl_autoload_register(function ($class) {
	$classFile = __DIR__.'/src/' . str_replace('\\', '/', $class) . '.php';
	if(file_exists($classFile)) require_once $classFile;
	elseif(!class_exists($class)) die("could 3 load class " . $class);
	else die("could not 0 load class " . $class);
});