<?php

declare(strict_types=1);

namespace App\Application\Actions\Travelers;

use Psr\Http\Message\ResponseInterface as Response;

class GetTravelersAction extends TravelersAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $travelers = $this->travelersRepository->findAll();

        $this->logger->info("Travelers list was viewed.");

        return $this->respondWithData($travelers);
    }
}
