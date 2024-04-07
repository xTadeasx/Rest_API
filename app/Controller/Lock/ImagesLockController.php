<?php declare(strict_types=1);

namespace App\Controller\Lock;

use Apitte\Core\Annotation\Controller as Apitte;
use Apitte\Core\Exception\Api\ServerErrorException;
use Apitte\Core\Http\ApiRequest;
use Apitte\Core\Http\ApiResponse;
use App\Facade\ImagesFacade;
use App\Model\Api\Request\ImagesCreateRequest;
use App\Model\Images;
use App\Repository\ImagesRepository;
use App\Response\OneImagesResponse;
use Doctrine\DBAL\Exception\DriverException;
use Nette\Application\Request;
use Nette\Application\Response;
use Nette\Application\Responses\TextResponse;
use Nette\Http\IResponse;

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

    /**
     * @Apitte\Path("/create")
     * @Apitte\Method("POST")
     * @Apitte\RequestBody(entity="App\Model\Api\Request\ImagesCreateRequest")
     */
    public function createLinks(ApiRequest $request, ApiResponse $response): ApiResponse {
        /** @var LinksCreateRequest $dto */
        $dto = $request->getParsedBody();
        try {
            $this->ImagesFacade->create($dto);
            return $response->withStatus(IResponse::S201_Created)
                ->withHeader('Content-Type', 'application/json');
        } catch (DriverException $e) {
            throw ServerErrorException::create()
                ->withMessage('Cannot create Images')
                ->withPrevious($e);
        }
    }
}