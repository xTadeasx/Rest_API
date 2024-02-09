<?php

namespace App\Controller;

use Apitte\Core\UI\Controller\IController;
use Apitte\Core\Annotation\Controller as Apitte;

/**
 * @Apitte\Path("/api")
 * @Apitte\Id("api")
 */
abstract class BaseController implements IController
{
}
