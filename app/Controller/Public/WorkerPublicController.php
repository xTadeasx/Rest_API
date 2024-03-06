<?php declare(strict_types=1);

namespace App\Controller\Public;

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
class WorkerPublicController extends PublicPublicController {

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
}
