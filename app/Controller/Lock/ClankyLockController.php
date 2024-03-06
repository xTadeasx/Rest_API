<?php declare(strict_types=1);

namespace App\Controller\Lock;

use Apitte\Core\Annotation\Controller as Apitte;
use Apitte\Core\Http\ApiRequest;
use App\Facade\ClankyFacade;
use App\Model\Clanky;
use App\Repository\ClankyRepository;
use App\Response\OneClankyResponse;
use Nette\Application\Request;
use Nette\Application\Response;
use Nette\Application\Responses\TextResponse;
use Nette\Http\IResponse;

/**
 * @Apitte\Path("/clanky")
 * @Apitte\Tag("Clanky")
 */
class ClankyLockController extends LockLockController {

    private ClankyFacade $ClankyFacade;

    /**
     * @param ClankyFacade $ClankyFacade
     */
    public function __construct(ClankyFacade $ClankyFacade)
    {
        $this->ClankyFacade = $ClankyFacade;
    }


}