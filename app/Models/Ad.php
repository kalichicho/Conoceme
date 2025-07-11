<?php
namespace App\Models;

use App\Core\Database;

class Ad
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all()
    {
        $result = $this->db->query("SELECT a.*, u.nombre, u.apellido FROM anuncios a JOIN usuarios u ON a.usuario_id = u.id ORDER BY fecha_publicacion DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO anuncios (usuario_id, categoria_id, titulo, descripcion, precio, ubicacion) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('iissds', $data['usuario_id'], $data['categoria_id'], $data['titulo'], $data['descripcion'], $data['precio'], $data['ubicacion']);
        return $stmt->execute();
    }
}
