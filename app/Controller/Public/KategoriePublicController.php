<?php declare(strict_types=1);

namespace App\Controller\Public;

use Apitte\Core\Annotation\Controller as Apitte;
use Apitte\Core\Http\ApiRequest;
use App\Facade\KategorieFacade;
use App\Model\Kategorie;
use App\Repository\KategorieRepository;
use App\Response\OneKategorieResponse;
use Nette\Application\Request;
use Nette\Application\Response;
use Nette\Application\Responses\TextResponse;

/**
 * @Apitte\Path("/kategorie")
 * @Apitte\Tag("Kategorie")
 */
class KategoriePublicController extends PublicPublicController {

    private KategorieFacade $KategorieFacade;

    /**
     * @param KategorieFacade $KategorieFacade
     */
    public function __construct(KategorieFacade $KategorieFacade)
    {
        $this->KategorieFacade = $KategorieFacade;
    }


    /**
     * @Apitte\Path("/")
     * @Apitte\Method("GET")
     * @return Kategorie[]
     */
    public function index(ApiRequest $request): array
    {
        $arr = $this->KategorieFacade->findAll();
        return $arr;
    }

    /**
     * @Apitte\Path("/{id}")
     * @Apitte\Method("GET")
     * */
    public function getById(ApiRequest $request): OneKategorieResponse {
        $Kategorie = $this->KategorieFacade->findOneBy(['id' => $request->getParameter('id')]);
        return OneKategorieResponse::fromModel($Kategorie);
    }
}