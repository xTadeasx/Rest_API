<?php declare(strict_types=1);

namespace App\Controller\Public;

use Apitte\Core\Annotation\Controller as Apitte;
use Apitte\Core\Http\ApiRequest;
use App\Facade\UzivateleFacade;
use App\Model\Uzivatele;
use App\Repository\UzivateleRepository;
use App\Response\OneUzivateleResponse;
use Nette\Application\Request;
use Nette\Application\Response;
use Nette\Application\Responses\TextResponse;

/**
 * @Apitte\Path("/uzivatele")
 * @Apitte\Tag("Uzivatele")
 */
class UzivatelePublicController extends PublicPublicController {

    private UzivateleFacade $UzivateleFacade;

    /**
     * @param UzivateleFacade $UzivateleFacade
     */
    public function __construct(UzivateleFacade $UzivateleFacade)
    {
        $this->UzivateleFacade = $UzivateleFacade;
    }


    /**
     * @Apitte\Path("/")
     * @Apitte\Method("GET")
     * @return Uzivatele[]
     */
    public function index(ApiRequest $request): array
    {
        $arr = $this->UzivateleFacade->findAll();
        return $arr;
    }

    /**
     * @Apitte\Path("/{id}")
     * @Apitte\Method("GET")
     * */
    public function getById(ApiRequest $request): OneUzivateleResponse {
        $Uzivatele = $this->UzivateleFacade->findOneBy(['id' => $request->getParameter('id')]);
        return OneUzivateleResponse::fromModel($Uzivatele);
    }
    /**
     * @Apitte\Path("/login")
     * @Apitte\Method("POST")
     * */
    public function get_token(ApiRequest $request): OneUzivateleResponse {
        $password = $_POST['password'];
        $Uzivatele = $this->UzivateleFacade->findOneBy(['password' => sha1($password)]);
        return OneUzivateleResponse::fromModel($Uzivatele);
    }
}