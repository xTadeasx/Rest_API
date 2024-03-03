<?php declare(strict_types=1);

namespace App\Controller;

use Apitte\Core\Annotation\Controller as Apitte;
use Apitte\Core\Http\ApiRequest;
use App\Facade\LinksFacade;
use App\Model\Links;
use App\Repository\LinksRepository;
use App\Response\OneLinksResponse;
use Nette\Application\Request;
use Nette\Application\Response;
use Nette\Application\Responses\TextResponse;

/**
 * @Apitte\Path("/links")
 * @Apitte\Tag("Links")
 */
class LinksController extends PublicController {

    private LinksFacade $LinksFacade;

    /**
     * @param LinksFacade $LinksFacade
     */
    public function __construct(LinksFacade $LinksFacade)
    {
        $this->LinksFacade = $LinksFacade;
    }


    /**
     * @Apitte\Path("/")
     * @Apitte\Method("GET")
     * @return Links[]
     */
    public function index(ApiRequest $request): array
    {
        $arr = $this->LinksFacade->findAll();
        return $arr;
    }

    /**
     * @Apitte\Path("/{id}")
     * @Apitte\Method("GET")
     * */
    public function getById(ApiRequest $request): OneLinksResponse {
        $Links = $this->LinksFacade->findOneBy(['id' => $request->getParameter('id')]);
        return OneLinksResponse::fromModel($Links);
    }
}