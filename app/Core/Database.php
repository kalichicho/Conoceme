<?php
namespace App\Core;

use mysqli;

class Database
{
    private static $instance;
    private $connection;

    private function __construct()
    {
        $config = require __DIR__ . '/../../config/database.php';
        $this->connection = new mysqli(
            $config['host'],
            $config['user'],
            $config['pass'],
            $config['name']
        );
        if ($this->connection->connect_error) {
            die('Connection error: ' . $this->connection->connect_error);
        }
        $this->connection->set_charset('utf8mb4');
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
