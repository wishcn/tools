<?php
class Emperor {
    private static $obj = null;
    private function __construct() {
    }

    public static function say() {
        echo "我是个皇帝!\n";
    }

    public static function getInstance() {
        if (self::$obj == null) {
            self::$obj = new Emperor();
        }
        return self::$obj;
    }
}

$s = Emperor::getInstance();
$s::say();