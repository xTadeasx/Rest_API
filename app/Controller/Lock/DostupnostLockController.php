<?php declare(strict_types=1);

namespace App\Controller\Lock;

use Apitte\Core\Annotation\Controller as Apitte;
use Apitte\Core\Exception\Api\ServerErrorException;
use Apitte\Core\Http\ApiRequest;
use Apitte\Core\Http\ApiResponse;
use App\Facade\DostupnostFacade;
use App\Model\Api\Request\DostupnostCreateRequest;
use App\Model\Dostupnost;
use App\Repository\DostupnostRepository;
use App\Response\OneDostupnostResponse;
use Doctrine\DBAL\Exception\DriverException;
use Nette\Application\Request;
use Nette\Application\Response;
use Nette\Application\Responses\TextResponse;
use Nette\Http\IResponse;

/**
 * @Apitte\Path("/dostupnost")
 * @Apitte\Tag("Dostupnost")
 */
class DostupnostLockController extends LockLockController {

    private DostupnostFacade $DostupnostFacade;

    /**
     * @param DostupnostFacade $DostupnostFacade
     */
    public function __construct(DostupnostFacade $DostupnostFacade)
    {
        $this->DostupnostFacade = $DostupnostFacade;
    }

}