<?php

namespace App\Http\Services\User\UserRegister;

class UserRegisterRequest
{
    private string $name;
    private string $username;
    private string $email;
    private string $password;

    /**
     * @param string $name
     * @param string $username
     * @param string $email
     * @param string $password
     */
    public function __construct(string $name, string $username, string $email, string $password)
    {
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

}
