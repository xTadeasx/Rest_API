<?php declare(strict_types=1);

namespace App\Controller\Lock;

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
class KategorieLockController extends LockLockController {

    private KategorieFacade $KategorieFacade;

    /**
     * @param KategorieFacade $KategorieFacade
     */

    public function __construct(KategorieFacade $KategorieFacade)
    {
        $this->KategorieFacade = $KategorieFacade;
    }

}