<?php

namespace App\models;

use App\config\Database;

class User extends Database
{
    private $errors = array();
    public function setFirstName($firstName)
    {
        if (strlen($firstName) < 3 || strlen($firstName) > 20 || !preg_match('/^[a-z -]+$/i', $firstName)) {
            $this->isValid = false;
            return $this->errors += ["firstName" => "Le format du champ est incorrect"];
        }
        return $this->firstName = htmlspecialchars($firstName);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getData()
    {
        return ['prenom' => $this->firstName, 'nom' => $this->lastName, 'email' => $this->email, 'mdp' => $this->mdp, 'role' => $this->role];
    }
    public function getDataEdit()
    {
        return ['id_client' => $this->idClient, 'prenom' => $this->firstName, 'nom' => $this->lastName, 'email' => $this->email, 'mdp' => $this->mdp, 'role' => $this->role];
    }
}

