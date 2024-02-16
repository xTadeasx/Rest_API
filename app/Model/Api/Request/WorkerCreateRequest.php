<?php

namespace App\Model\Api\Request;

class WorkerCreateRequest {

    public string $name;
    public string $surName;
    public string $title;
    public string $job;
    public string $phoneNumber;
    public string $email;
    public int $active;
}
