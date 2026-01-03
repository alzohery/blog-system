<?php

namespace App\Modules\Users\DTOs;

class UserDTO
{
    public string $name;
    public string $email;
    public ?string $password;
    public bool $is_active;

    public function __construct(array $data)
    {
        $this->name      = $data['name'];
        $this->email     = $data['email'];
        $this->password  = $data['password'] ?? null;
        $this->is_active = $data['is_active'] ?? true;
    }
}
