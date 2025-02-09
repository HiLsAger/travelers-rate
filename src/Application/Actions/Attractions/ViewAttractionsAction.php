<?php

declare(strict_types=1);

namespace App\Application\Actions\Attractions;

use Psr\Http\Message\ResponseInterface as Response;

class ViewAttractionsAction extends AttractionsAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $cityId = (int) $this->resolveArg('id');
        $city = $this->attractionsRepository->findUserOfId($cityId);

        $this->logger->info("City of id `$cityId` was viewed.");

        return $this->respondWithData($city);
    }
}
