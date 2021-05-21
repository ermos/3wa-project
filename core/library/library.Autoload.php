<?php
spl_autoload_register(function ($class_name) {
	switch ($class_name) {
		case str_contains($class_name, "core"):
			addClass($class_name, "core", "core/class/");
			break;
		case str_contains($class_name, "model"):
			addClass($class_name, "model", "src/model/");
			break;
	}
});

function addClass($class_name, $namespace, $path) {
	$class_name = str_replace($namespace."\\", "", $class_name);
	if (file_exists(sprintf($path."class.%s.php", $class_name))) {
		require_once sprintf($path."class.%s.php", $class_name);

		if (method_exists($class_name, '__init')) {
			$class_name::__init();
		}
	}
}
