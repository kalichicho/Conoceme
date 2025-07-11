<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Ad;

class HomeController extends Controller
{
    public function index()
    {
        $adModel = new Ad();
        $ads = $adModel->all();
        return $this->view('home', ['ads' => $ads]);
    }
}
