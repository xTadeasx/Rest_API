<?php declare(strict_types=1);

namespace App\Controller\Public;

use Apitte\Core\Annotation\Controller as Apitte;
use Apitte\Core\Http\ApiRequest;
use App\Facade\DostupnostFacade;
use App\Model\Dostupnost;
use App\Repository\DostupnostRepository;
use App\Response\OneDostupnostResponse;
use Nette\Application\Request;
use Nette\Application\Response;
use Nette\Application\Responses\TextResponse;

/**
 * @Apitte\Path("/dostupnost")
 * @Apitte\Tag("Dostupnost")
 */
class DostupnostPublicController extends PublicPublicController {

    private DostupnostFacade $DostupnostFacade;

    /**
     * @param DostupnostFacade $DostupnostFacade
     */
    public function __construct(DostupnostFacade $DostupnostFacade)
    {
        $this->DostupnostFacade = $DostupnostFacade;
    }


    /**
     * @Apitte\Path("/")
     * @Apitte\Method("GET")
     * @return Dostupnost[]
     */
    public function index(ApiRequest $request): array
    {
        $arr = $this->DostupnostFacade->findAll();
        return $arr;
    }

    /**
     * @Apitte\Path("/{id}")
     * @Apitte\Method("GET")
     * */
    public function getById(ApiRequest $request): OneDostupnostResponse {
        $Dostupnost = $this->DostupnostFacade->findOneBy(['id' => $request->getParameter('id')]);
        return OneDostupnostResponse::fromModel($Dostupnost);
    }
}