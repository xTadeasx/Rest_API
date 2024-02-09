<?php

namespace App\Response;

use App\Model\Links;

class OneLinksResponse
{
    public int $id;
    public string $link_name;
    public static function fromModel(Links $Links): self {
        $self = new self();
        $self->id = $Links->getId();
        $self->link_name = $Links->getLinkName();
        return $self;
    }
}
