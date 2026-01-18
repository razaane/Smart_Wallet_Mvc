<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller {

    public function register(array $data) {
        $user = new User(
            $data['email'] ?? '',
            $data['password'] ?? '',
            $data['role'] ?? 'user',
            $data['fullname'] ?? ''
        );

        if ($user->signUp()) {
            $_SESSION['success'] = "User registered successfully!";
            $this->redirect('login'); // example method in Controller.php
        } else {
            $_SESSION['error'] = "Email already exists!";
            $this->loadView('auth/register', $data);
        }
    }

    public function login(array $data) {
        $user = new User($data['email'] ?? '', $data['password'] ?? '');

        $userData = $user->login();
        if ($userData) {
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['user_role'] = $userData['role'];
            $this->redirect('dashboard'); // example
        } else {
            $_SESSION['error'] = "Email or Password Wrong!";
            $this->loadView('auth/login', $data);
        }
    }

    public function logout() {
        session_destroy();
        $this->redirect('login');
    }
}
