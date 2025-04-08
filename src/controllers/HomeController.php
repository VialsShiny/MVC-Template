<?php

namespace App\controllers;

class HomeController extends Controller
{
    public function index()
    {
        return $this->render('home.html.twig', ["user" => $_SESSION['user'] ?? null]);
    }
}