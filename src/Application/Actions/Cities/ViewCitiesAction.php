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
        $cityId = (int) $this->resolveArg('id');
        $city = $this->citiesRepository->findUserOfId($cityId);

        $this->logger->info("City of id `$cityId` was viewed.");

        return $this->respondWithData($city);
    }
}
