<?php

namespace App\controllers;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
class Controller
{
    public function render($view, $data) {
        $loader = new FilesystemLoader('src/views');
        $twig = new Environment($loader);

        echo $twig->render($view, $data);
    }
}