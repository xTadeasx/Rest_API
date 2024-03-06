<?php declare(strict_types=1);

namespace App\Controller\Lock;

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
class ImagesLockController extends LockLockController {

    private ImagesFacade $ImagesFacade;

    /**
     * @param ImagesFacade $ImagesFacade
     */
    public function __construct(ImagesFacade $ImagesFacade)
    {
        $this->ImagesFacade = $ImagesFacade;
    }


}