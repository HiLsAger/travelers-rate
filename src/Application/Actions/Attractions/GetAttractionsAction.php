<?php

declare(strict_types=1);

namespace App\Application\Actions\Attractions;

use Psr\Http\Message\ResponseInterface as Response;

class GetAttractionsAction extends AttractionsAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $model = $this->repository->findAll($this->request->getQueryParams());

        return $this->respondWithData($model);
    }
}
