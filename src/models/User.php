<?php

namespace App\Models;

use App\Config\Database;

/**
 * Template Model Class for User.
 *
 * Note: This is a template and should not be used as-is in production.
 */
class User extends Database
{
    /**
     * Errors array to store validation messages.
     *
     * @var array
     */
    private $errors = [];

    /**
     * User properties.
     */
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $role;
    private $clientId;

    /**
     * Set the user's first name.
     *
     * @param string $firstName The first name of the user.
     * @return void
     */
    public function setFirstName($firstName)
    {
        if (strlen($firstName) < 3 || strlen($firstName) > 20 || !preg_match('/^[a-z -]+$/i', $firstName)) {
            // Error: The field format is incorrect.
            $this->errors['firstName'] = "The field format is incorrect";
            return;
        }
        $this->firstName = htmlspecialchars($firstName);
    }

    /**
     * Get validation errors.
     *
     * @return array The array of error messages.
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Get user data for general use.
     *
     * @return array Associative array containing user data.
     */
    public function getData()
    {
        return [
            'firstName' => $this->firstName,
            'lastName'  => $this->lastName,
            'email'     => $this->email,
            'password'  => $this->password,
            'role'      => $this->role
        ];
    }

    /**
     * Get user data for editing purposes.
     *
     * @return array Associative array containing user data with client ID.
     */
    public function getDataEdit()
    {
        return [
            'clientId'  => $this->clientId,
            'firstName' => $this->firstName,
            'lastName'  => $this->lastName,
            'email'     => $this->email,
            'password'  => $this->password,
            'role'      => $this->role
        ];
    }
}
