<?php
namespace core;

class Head {

    private static $title = APP_NAME;

    public static function setTitle($title) {
        self::$title = "$title - " . APP_NAME;
    }

    public static function getTitle() {
        return self::$title;
    }

}