<?php declare(strict_types=1);

namespace App\Controller;

use Apitte\Core\Annotation\Controller as Apitte;
use Apitte\Core\Http\ApiRequest;
use App\Facade\ImagesFacade;
use App\Model\Images;
use App\Repository\ImagesRepository;
use App\Response\OneImagesResponse;
use Nette\Application\Request;
use Nette\Application\Response;
use Nette\Application\Responses\TextResponse;

/**
 * @Apitte\Path("/images")
 * @Apitte\Tag("Images")
 */
class ImagesController extends BaseController {

    private ImagesFacade $ImagesFacade;

    /**
     * @param ImagesFacade $ImagesFacade
     */
    public function __construct(ImagesFacade $ImagesFacade)
    {
        $this->ImagesFacade = $ImagesFacade;
    }


    /**
     * @Apitte\Path("/")
     * @Apitte\Method("GET")
     * @return Images[]
     */
    public function index(ApiRequest $request): array
    {
        $arr = $this->ImagesFacade->findAll();
        return $arr;
    }

    /**
     * @Apitte\Path("/{id}")
     * @Apitte\Method("GET")
     * */
    public function getById(ApiRequest $request): OneImagesResponse {
        $Images = $this->ImagesFacade->findOneBy(['id' => $request->getParameter('id')]);
        return OneImagesResponse::fromModel($Images);
    }
}