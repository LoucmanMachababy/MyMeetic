<?php
class Database {
    private static $instance;
    private $db;

    private function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=Afrika', 'phpmyadmin', 'Mouslime74');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance->db;
    }
}
?>
