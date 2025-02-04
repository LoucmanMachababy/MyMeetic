<?php
class Database {
    private static $instance;
    private $db;

    private function __construct() {
        
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance->db;
    }
}
?>