<?php

namespace App\Controllers;

/**
 * Home Controller Template.
 *
 * This controller is responsible for handling the homepage request.
 * Note: This is a template and can be customized for your needs.
 */
class HomeController extends Controller
{
    /**
     * Render the homepage view.
     *
     * @return mixed The rendered view of home.html.twig.
     */
    public function index()
    {
        $currentUser = $_SESSION['user'] ?? null;
        return $this->render('home.html.twig', ["currentUser" => $currentUser]);
    }
}
