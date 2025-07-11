<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return $this->view('auth/login');
    }

    public function doLogin()
    {
        // TODO: implementar autenticación
    }

    public function register()
    {
        return $this->view('auth/register');
    }

    public function doRegister()
    {
        $user = new User();
        $data = [
            'nombre' => $_POST['nombre'] ?? '',
            'apellido' => $_POST['apellido'] ?? '',
            'email' => $_POST['email'] ?? '',
            'password' => password_hash($_POST['password'] ?? '', PASSWORD_BCRYPT),
            'fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? '',
        ];
        $user->create($data);
        header('Location: /');
    }
}
