<?php

namespace App\Response;

use App\Model\Images;

class OneImagesResponse
{
    public int $id;
    public string $file_name;
    public static function fromModel(Images $Images): self {
        $self = new self();
        $self->id = $Images->getId();
        $self->file_name = $Images->getFileName();
        return $self;
    }
}
