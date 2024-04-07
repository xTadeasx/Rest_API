<?php

namespace App\Model\Api\Request;

class UzivateleCreateRequest {

    public string $username;
    public string $password;
    public string $name;
    public string $sur_name;
    public int $dostupnost;
    public int $active;
}
