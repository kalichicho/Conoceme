<?php
namespace App\Models;

use App\Core\Database;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($data)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO usuarios (nombre, apellido, email, password_hash, telefono, fecha_nacimiento) VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param(
            'ssssss',
            $data['nombre'],
            $data['apellido'],
            $data['email'],
            $data['password'],
            $data['telefono'],
            $data['fecha_nacimiento']
        );
        return $stmt->execute();
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = ? LIMIT 1");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
