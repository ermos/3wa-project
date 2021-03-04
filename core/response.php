<?php

class Response {

    static public function Show($view, $data) {
        $path = "src/views/$view.php";
        if(file_exists($path)) {
            require_once $path;
        }
    }

}