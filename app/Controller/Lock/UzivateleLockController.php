<?php declare(strict_types=1);

namespace App\Controller\Lock;

use Apitte\Core\Annotation\Controller as Apitte;
use Apitte\Core\Exception\Api\ServerErrorException;
use Apitte\Core\Http\ApiRequest;
use Apitte\Core\Http\ApiResponse;
use App\Facade\UzivateleFacade;
use App\Model\Api\Request\UzivateleCreateRequest;
use App\Model\Uzivatele;
use App\Repository\UzivateleRepository;
use App\Response\OneUzivateleResponse;
use Doctrine\DBAL\Exception\DriverException;
use Nette\Application\Request;
use Nette\Application\Response;
use Nette\Application\Responses\TextResponse;
use Nette\Http\IResponse;

/**
 * @Apitte\Path("/uzivatele")
 * @Apitte\Tag("Uzivatele")
 */
class UzivateleLockController extends LockLockController {

    private UzivateleFacade $UzivateleFacade;

    /**
     * @param UzivateleFacade $UzivateleFacade
     */
    public function __construct(UzivateleFacade $UzivateleFacade)
    {
        $this->UzivateleFacade = $UzivateleFacade;
    }

    /**
     * @Apitte\Path("/create")
     * @Apitte\Method("POST")
     * @Apitte\RequestBody(entity="App\Model\Api\Request\UzivateleCreateRequest")
     */
    public function createUzivatele(ApiRequest $request, ApiResponse $response): ApiResponse {
        /** @var UzivateleCreateRequest $dto */
        $dto = $request->getParsedBody();
        try {
            $this->UzivateleFacade->create($dto);
            return $response->withStatus(IResponse::S201_Created)
                ->withHeader('Content-Type', 'application/json');
        } catch (DriverException $e) {
            throw ServerErrorException::create()
                ->withMessage('Cannot create Uzivatele')
                ->withPrevious($e);
        }
    }
}