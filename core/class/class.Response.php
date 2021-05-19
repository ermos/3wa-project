<?php
namespace core;

class Response {

    static public function Show($view, $data) {
        $path = "src/views/$view.php";
        if(file_exists($path)) {
            require_once $path;
        }
    }

    static public function API($http_code = 200, $data = []) {
    	http_response_code($http_code);
    	echo json_encode($data);
	}

}