<?php declare(strict_types=1);

namespace App\Controller\Lock;

use Apitte\Core\Annotation\Controller as Apitte;
use Apitte\Core\Exception\Api\ServerErrorException;
use Apitte\Core\Http\ApiRequest;
use Apitte\Core\Http\ApiResponse;
use App\Facade\LinksFacade;
use App\Model\Api\Request\LinksCreateRequest;
use App\Model\Links;
use App\Repository\LinksRepository;
use App\Response\OneLinksResponse;
use Doctrine\DBAL\Exception\DriverException;
use Nette\Application\Request;
use Nette\Application\Response;
use Nette\Application\Responses\TextResponse;
use Nette\Http\IResponse;

/**
 * @Apitte\Path("/links")
 * @Apitte\Tag("Links")
 */
class LinksLockController extends LockLockController {

    private LinksFacade $LinksFacade;

    /**
     * @param LinksFacade $LinksFacade
     */
    public function __construct(LinksFacade $LinksFacade)
    {
        $this->LinksFacade = $LinksFacade;
    }
    /**
     * @Apitte\Path("/create")
     * @Apitte\Method("POST")
     * @Apitte\RequestBody(entity="App\Model\Api\Request\LinksCreateRequest")
     */
    public function createLinks(ApiRequest $request, ApiResponse $response): ApiResponse {
        /** @var LinksCreateRequest $dto */
        $dto = $request->getParsedBody();
        try {
            $this->LinksFacade->create($dto);
            return $response->withStatus(IResponse::S201_Created)
                ->withHeader('Content-Type', 'application/json');
        } catch (DriverException $e) {
            throw ServerErrorException::create()
                ->withMessage('Cannot create Links')
                ->withPrevious($e);
        }
    }
}