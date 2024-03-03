<?php

namespace App\Response;

use App\Model\clanky;
use DateTime;
class OneclankyResponse
{
    public int $id;
    public string $kategorie;
    public string $name;
    public string $sub_name;
    public DateTime $cas_konani;
    public string $text;
    public string $img_file_name;
    public int $active;

    public static function fromModel(clanky $clanky): self {
        $self = new self();
        $self->id = $clanky->getId();
        $self->kategorie = $clanky->getKategorie();
        $self->name = $clanky->getName();
        $self->sub_name = $clanky->getSubName();
        $self->cas_konani = $clanky->getCasKonani();
        $self->text = $clanky->getText();
        $self->img_file_name = $clanky->getImage();
        $self->active = $clanky->getActive();

        return $self;
    }
}
