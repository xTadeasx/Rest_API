<?php declare(strict_types=1);

namespace App\Controller;

use Apitte\Core\Annotation\Controller as Apitte;
use Apitte\Core\Http\ApiRequest;
use App\Facade\WorkerFacade;
use App\Model\Worker;
use App\Repository\WorkerRepository;
use App\Response\OneWorkerResponse;
use Nette\Application\Request;
use Nette\Application\Response;
use Nette\Application\Responses\TextResponse;

/**
 * @Apitte\Path("/workers")
 * @Apitte\Tag("Workers")
 */
class WorkerController extends BaseController {

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
