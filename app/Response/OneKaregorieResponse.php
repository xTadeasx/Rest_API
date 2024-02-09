<?php

namespace App\Response;

use App\Model\Kategorie;

class OneKategorieResponse
{
    public int $id;
    public string $name;
    public string $sub_kategorie_to;
    public string $active;
    public static function fromModel(Kategorie $Kategorie): self {
        $self = new self();
        $self->id = $Kategorie->getId();
        $self->name = $Kategorie->getName();
        $self->sub_kategorie_to = $Kategorie->getSubKategoriTo();
        $self->active = $Kategorie->getActive();
        return $self;
    }
}
