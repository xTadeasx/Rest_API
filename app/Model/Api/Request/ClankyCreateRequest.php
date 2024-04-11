<?php

namespace App\Model\Api\Request;
use DateTime;
class ClankyCreateRequest {

    public int $kategorie;
    public string $name;
    public string $subName;
    public DateTime $casKonani;
    public string $text;
    public string $imgFileName;
    public string $slag;
    public int $active;
}
