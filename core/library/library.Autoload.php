<?php
spl_autoload_register(function ($class_name) {
	$class_name = str_replace("core\\", "", $class_name);
	if (file_exists(sprintf("core/class/class.%s.php", $class_name))) {
		require_once sprintf("core/class/class.%s.php", $class_name);

		if (method_exists($class_name, '__init')) {
			$class_name::__init();
		}
	}
});
