<?php
namespace App\Core;

class Controller {
    protected function loadModel($model){
        require_once __DIR__ . "/../models/{$model}.php";
        return new $model();
    }
    
    protected function loadView($view, $data = []) {
        extract($data);
        require __DIR__ . '/../views/' . $view . '.php';
    }

    protected function redirect($url) {
        header("Location: /$url");
        exit;
    }
}
