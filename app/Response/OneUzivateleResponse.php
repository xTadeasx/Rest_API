<?php

namespace App\Response;

use App\Model\Uzivatele;

class OneUzivateleResponse
{
    public int $id;
    public string $username;
    public string $password;
    public string $name;
    public string $surname;
    public string $dostupnost;
    public int $active;
    public string $token;

    public static function fromModel(Uzivatele $Uzivatele): self {
        $self = new self();
        $self->id = $Uzivatele->getId();
        $self->username = $Uzivatele->getUsername();
        $self->password = $Uzivatele->getPassword();
        $self->name = $Uzivatele->getName();
        $self->surname = $Uzivatele->getSurname();
        $self->dostupnost = $Uzivatele->getDostupnost();
        $self->active = $Uzivatele->getActive();
        $self->token = $Uzivatele->getToken();

        return $self;
    }
}
