<?php

declare(strict_types=1);

namespace App\Application\Actions\Cities;

use Psr\Http\Message\ResponseInterface as Response;

class ViewCitiesAction extends CitiesAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $id = (int) $this->resolveArg('id');
        $model = $this->repository->findModelOfId($id);

        return $this->respondWithData($model);
    }
}
