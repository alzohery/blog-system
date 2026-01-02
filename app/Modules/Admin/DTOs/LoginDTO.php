<?php

namespace App\Modules\Admin\DTOs;

/**
 * Class LoginDTO
 * Data Transfer Object to carry login form data from Controller to Service
 */
class LoginDTO
{
    public string $email;
    public string $password;

    /**
     * Constructor
     *
     * @param array $data  Array of validated form data
     */
    public function __construct(array $data)
    {
        $this->email = $data['email'];
        $this->password = $data['password'];
    }
}
