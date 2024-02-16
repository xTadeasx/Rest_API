<?php declare(strict_types = 1);

namespace App\Security;

use Apitte\Core\Http\RequestAttributes as ApitteRequestAttributes;

interface RequestAttributes extends ApitteRequestAttributes
{

	public const APP_LOGGED_USER = 'app.logged.user';

}
