<?php
spl_autoload_register(function ($class) {
	$classFile = __DIR__.'/src/' . str_replace('\\', '/', $class) . '.php';
	if(file_exists($classFile)) require_once $classFile;
	else die("could not load class " . $class);
});