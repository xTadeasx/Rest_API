<?php

namespace App\Response;

use App\Model\Dostupnost;

class OneDostupnostResponse
{
    public int $id;
    public string $name;
    public static function fromModel(Dostupnost $Dostupnost): self {
        $self = new self();
        $self->id = $Dostupnost->getId();
        $self->name = $Dostupnost->getName();
        return $self;
    }
}
