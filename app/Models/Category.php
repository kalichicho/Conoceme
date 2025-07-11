<?php
namespace App\Models;

use App\Core\Database;

class Category
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all()
    {
        $result = $this->db->query("SELECT * FROM categorias ORDER BY nombre");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
