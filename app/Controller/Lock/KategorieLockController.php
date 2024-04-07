<?php declare(strict_types=1);

namespace App\Controller\Lock;

use Apitte\Core\Annotation\Controller as Apitte;
use Apitte\Core\Exception\Api\ServerErrorException;
use Apitte\Core\Http\ApiRequest;
use Apitte\Core\Http\ApiResponse;
use App\Facade\KategorieFacade;
use App\Model\Api\Request\KategorieCreateRequest;
use App\Model\Kategorie;
use App\Repository\KategorieRepository;
use App\Response\OneKategorieResponse;
use Doctrine\DBAL\Exception\DriverException;
use Nette\Application\Request;
use Nette\Application\Response;
use Nette\Application\Responses\TextResponse;
use Nette\Http\IResponse;

/**
 * @Apitte\Path("/kategorie")
 * @Apitte\Tag("Kategorie")
 */
class KategorieLockController extends LockLockController {

    private KategorieFacade $KategorieFacade;

    /**
     * @param KategorieFacade $KategorieFacade
     */

    public function __construct(KategorieFacade $KategorieFacade)
    {
        $this->KategorieFacade = $KategorieFacade;
    }
    /**
     * @Apitte\Path("/create")
     * @Apitte\Method("POST")
     * @Apitte\RequestBody(entity="App\Model\Api\Request\KategorieCreateRequest")
     */
    public function createKategorie(ApiRequest $request, ApiResponse $response): ApiResponse {
        /** @var kategorieCreateRequest $dto */
        $dto = $request->getParsedBody();
        try {
            $this->KategorieFacade->create($dto);
            return $response->withStatus(IResponse::S201_Created)
                ->withHeader('Content-Type', 'application/json');
        } catch (DriverException $e) {
            throw ServerErrorException::create()
                ->withMessage('Cannot create Kategorie')
                ->withPrevious($e);
        }
    }
}