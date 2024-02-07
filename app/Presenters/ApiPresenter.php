<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Nette\Utils\Json;
use App\Model\PostFacade;

final class APIPresenter extends Nette\Application\UI\Presenter
{
	public function __construct(private PostFacade $facade) 
    {

    }

    public function renderDefault(string $table, $activate, int $id): void
    { 
        $httpRequest = $this->getHttpRequest();
        
    //GET
        if($httpRequest->isMethod('GET')=="GET")
        {
            // www/API/<table>/sloupec.seředit(id.ASC)/<id>
            echo Json::encode($this->facade->get_worker($table, $activate, $id));

        }

    //POST
        else if($httpRequest->isMethod('POST')=="POST")
        {
            // www/API/uzivatele/login
            if($table == "uzivatele" && $activate=="login")
            {
                echo Json::encode($this->facade->login_users($table));
                exit;
            }

            // www/API/workers
            if($table != "")
            {
                echo Json::encode($this->facade->post_table($table));
            }
        }

    //PUT
        else if($httpRequest->isMethod('PUT')=="PUT")
        {
            // www/API/workers/update/<id>
            echo Json::encode($this->facade->put_table($table, $id));

        }

    //DELETE
        else if($httpRequest->isMethod('DELETE')=="DELETE")
        {
            // www/API/<table>/0/<id>
            if ($activate == 0)
            {
                echo Json::encode($this->facade->delete_worker($table, $id));
            }

            // www/API/<table>/1/<id>
            if ($activate == 1)
            {
                echo Json::encode($this->facade->activate_worker($table, $id));
            }

        }

    }
}
