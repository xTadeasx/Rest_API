<?php

namespace App\Model\Api\Request;

class KategorieCreateRequest {

    public int $id;
    public string $name;
    public string $sub_kategori_to;
    public int $active;
}
