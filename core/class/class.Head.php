<?php
namespace core;

class Head {

    private static string $title = APP_NAME;

    public static function setTitle($title): void {
        self::$title = "$title - " . APP_NAME;
    }

    public static function getTitle(): string {
        return self::$title;
    }

}