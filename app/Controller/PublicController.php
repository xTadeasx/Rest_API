<?php

namespace App\Controller;

use Apitte\Core\UI\Controller\IController;
use Apitte\Core\Annotation\Controller as Apitte;

/**
 * @Apitte\Path("/public")
 * @Apitte\Id("public")
 */
abstract class PublicController extends BaseController
{

}