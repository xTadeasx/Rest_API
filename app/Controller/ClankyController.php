<?php declare(strict_types=1);

namespace App\Controller;

use Apitte\Core\Annotation\Controller as Apitte;
use Apitte\Core\Http\ApiRequest;
use App\Facade\ClankyFacade;
use App\Model\Clanky;
use App\Repository\ClankyRepository;
use App\Response\OneClankyResponse;
use Nette\Application\Request;
use Nette\Application\Response;
use Nette\Application\Responses\TextResponse;

/**
 * @Apitte\Path("/clanky")
 * @Apitte\Tag("Clanky")
 */
class ClankyController extends BaseController {

    private ClankyFacade $ClankyFacade;

    /**
     * @param ClankyFacade $ClankyFacade
     */
    public function __construct(ClankyFacade $ClankyFacade)
    {
        $this->ClankyFacade = $ClankyFacade;
    }


    /**
     * @Apitte\Path("/")
     * @Apitte\Method("GET")
     * @return Clanky[]
     */
    public function index(ApiRequest $request): array
    {
        $arr = $this->ClankyFacade->findAll();
        return $arr;
    }

    /**
     * @Apitte\Path("/{id}")
     * @Apitte\Method("GET")
     * */
    public function getById(ApiRequest $request): OneClankyResponse {
        $Clanky = $this->ClankyFacade->findOneBy(['id' => $request->getParameter('id')]);
        return OneClankyResponse::fromModel($Clanky);
    }
}