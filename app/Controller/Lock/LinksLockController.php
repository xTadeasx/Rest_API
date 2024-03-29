<?php declare(strict_types=1);

namespace App\Controller\Lock;

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
class LinksLockController extends LockLockController {

    private LinksFacade $LinksFacade;

    /**
     * @param LinksFacade $LinksFacade
     */
    public function __construct(LinksFacade $LinksFacade)
    {
        $this->LinksFacade = $LinksFacade;
    }
}