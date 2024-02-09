<?php

namespace App\Response;

use App\Model\Worker;

class OneWorkerResponse
{
    public int $id;
    public string $name;
    public string $surName;
    public string $title;
    public string $job;
    public string $phoneNumber;
    public string $email;
    public int $active;

    public static function fromModel(Worker $worker): self {
        $self = new self();
        $self->id = $worker->getId();
        $self->name = $worker->getName();
        $self->surName = $worker->getSurName();
        $self->title = $worker->getTitle();
        $self->job = $worker->getJob();
        $self->phoneNumber = $worker->getPhoneNumber();
        $self->email = $worker->getEmail();
        $self->active = $worker->getActive();

        return $self;
    }
}
