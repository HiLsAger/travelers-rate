<?php

declare(strict_types=1);

namespace App\Application\Actions\Cities;

use Psr\Http\Message\ResponseInterface as Response;

class GetCitiesAction extends CitiesAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $cities = $this->citiesRepository->findAll();

        $this->logger->info("Cities list was viewed.");

        return $this->respondWithData($cities);
    }
}
