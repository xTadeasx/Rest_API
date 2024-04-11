<?php

namespace App\Model\Api\Request;

class KategorieCreateRequest {

    public string $name;
    public string $subKategoriTo;
    public int $active;
}
