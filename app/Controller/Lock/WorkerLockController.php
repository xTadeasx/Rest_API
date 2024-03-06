<?php declare(strict_types=1);

namespace App\Controller\Lock;

use Apitte\Core\Annotation\Controller as Apitte;
use Apitte\Core\Exception\Api\ServerErrorException;
use Apitte\Core\Http\ApiRequest;
use Apitte\Core\Http\ApiResponse;
use App\Facade\WorkerFacade;
use App\Model\Api\Request\WorkerCreateRequest;
use App\Model\Worker;
use App\Repository\WorkerRepository;
use App\Response\OneWorkerResponse;
use Doctrine\DBAL\Exception\DriverException;
use Nette\Application\Request;
use Nette\Application\Response;
use Nette\Application\Responses\TextResponse;
use Nette\Http\IResponse;

/**
 * @Apitte\Path("/workers")
 * @Apitte\Tag("Workers")
 */
class WorkerLockController extends LockLockController {

    private WorkerFacade $workerFacade;

    /**
     * @param WorkerFacade $workerFacade
     */
    public function __construct(WorkerFacade $workerFacade)
    {
        $this->workerFacade = $workerFacade;
    }


    /**
     * @Apitte\Path("/")
     * @Apitte\Method("GET")
     * @return Worker[]
     */
    public function index(ApiRequest $request): array
    {
        $arr = $this->workerFacade->findAll();
        return $arr;
    }

    /**
     * @Apitte\Path("/{id}")
     * @Apitte\Method("GET")
     * */
    public function getById(ApiRequest $request): OneWorkerResponse {
        $worker = $this->workerFacade->findOneBy(['id' => $request->getParameter('id')]);
        return OneWorkerResponse::fromModel($worker);
    }

    /**
     * @Apitte\Path("/create")
     * @Apitte\Method("POST")
     * @Apitte\RequestBody(entity="App\Model\Api\Request\WorkerCreateRequest")
     */
    public function createWorker(ApiRequest $request, ApiResponse $response): ApiResponse {
        /** @var WorkerCreateRequest $dto */
        $dto = $request->getParsedBody();
        try {
            $this->workerFacade->create($dto);
            return $response->withStatus(IResponse::S201_Created)
                ->withHeader('Content-Type', 'application/json');
        } catch (DriverException $e) {
            throw ServerErrorException::create()
                ->withMessage('Cannot create worker')
                ->withPrevious($e);
        }
    }
}
