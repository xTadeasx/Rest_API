<?php declare(strict_types=1);

namespace App\Controller\Lock;

use Apitte\Core\Annotation\Controller as Apitte;
use Apitte\Core\Exception\Api\ServerErrorException;
use Apitte\Core\Http\ApiRequest;
use Apitte\Core\Http\ApiResponse;
use App\Facade\ClankyFacade;
use App\Model\Api\Request\ClankyCreateRequest;
use App\Model\Clanky;
use App\Repository\ClankyRepository;
use App\Response\OneClankyResponse;
use Doctrine\DBAL\Exception\DriverException;
use Nette\Application\Request;
use Nette\Application\Response;
use Nette\Application\Responses\TextResponse;
use Nette\Http\IResponse;

/**
 * @Apitte\Path("/clanky")
 * @Apitte\Tag("Clanky")
 */
class ClankyLockController extends LockLockController {

    private ClankyFacade $ClankyFacade;

    /**
     * @param ClankyFacade $ClankyFacade
     */
    public function __construct(ClankyFacade $ClankyFacade)
    {
        $this->ClankyFacade = $ClankyFacade;
    }

    /**
     * @Apitte\Path("/create")
     * @Apitte\Method("POST")
     * @Apitte\RequestBody(entity="App\Model\Api\Request\ClankyCreateRequest")
     */
    public function createClanky(ApiRequest $request, ApiResponse $response): ApiResponse {
        /** @var ClankyCreateRequest $dto */
        $dto = $request->getParsedBody();
        try {
            $this->ClankyFacade->create($dto);
            return $response->withStatus(IResponse::S201_Created)
                ->withHeader('Content-Type', 'application/json');
        } catch (DriverException $e) {
            throw ServerErrorException::create()
                ->withMessage('Cannot create Clanky')
                ->withPrevious($e);
        }
    }
}