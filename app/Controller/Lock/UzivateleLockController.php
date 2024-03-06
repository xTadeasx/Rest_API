<?php declare(strict_types=1);

namespace App\Controller\Lock;

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
class UzivateleLockController extends LockLockController {

    private UzivateleFacade $UzivateleFacade;

    /**
     * @param UzivateleFacade $UzivateleFacade
     */
    public function __construct(UzivateleFacade $UzivateleFacade)
    {
        $this->UzivateleFacade = $UzivateleFacade;
    }


}