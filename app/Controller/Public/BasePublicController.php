<?php

namespace App\Controller\Public;

use Apitte\Core\UI\Controller\IController;
use Apitte\Core\Annotation\Controller as Apitte;

/**
 * @Apitte\Path("/api")
 * @Apitte\Id("api")
 */
abstract class BasePublicController implements IController
{
}
