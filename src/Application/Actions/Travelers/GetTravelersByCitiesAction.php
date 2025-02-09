<?php

declare(strict_types=1);

namespace App\Application\Actions\Travelers;

use App\Application\Actions\Cities\CitiesAction;
use Psr\Http\Message\ResponseInterface as Response;

class GetTravelersByCitiesAction extends TravelersAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $id = (int)$this->resolveArg('id');
        $model = $this->repository->getTravelersByCities($id);

        return $this->respondWithData($model);
    }
}
