<?php

declare(strict_types=1);

namespace App\Application\Actions\Cities;

use App\Domain\Cities\Cities;
use Psr\Http\Message\ResponseInterface as Response;

class GetCitiesAction extends CitiesAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        /**
         * @var Cities $model
         */
        $model = $this->repository->findAll();

        $this->logger->info("Cities list was viewed.");

        return $this->respondWithData($model);
    }
}
