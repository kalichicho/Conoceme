<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Ad;
use App\Models\Category;

class AdController extends Controller
{
    public function create()
    {
        $catModel = new Category();
        $categories = $catModel->all();
        return $this->view('ads/create', ['categories' => $categories]);
    }

    public function store()
    {
        // Dummy user id for example
        $userId = 1;
        $ad = new Ad();
        $data = [
            'usuario_id' => $userId,
            'categoria_id' => $_POST['categoria_id'] ?? 1,
            'titulo' => $_POST['titulo'] ?? '',
            'descripcion' => $_POST['descripcion'] ?? '',
            'precio' => $_POST['precio'] ?? 0,
            'ubicacion' => $_POST['ubicacion'] ?? '',
        ];
        $ad->create($data);
        header('Location: /');
    }
}
