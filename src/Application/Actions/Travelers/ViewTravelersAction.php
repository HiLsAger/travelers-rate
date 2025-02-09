<?php

declare(strict_types=1);

namespace App\Application\Actions\Travelers;

use Psr\Http\Message\ResponseInterface as Response;

class ViewTravelersAction extends TravelersAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $travelerId = (int) $this->resolveArg('id');
        $traveler = $this->travelersRepository->findUserOfId($travelerId);

        $this->logger->info("Traveler of id `$travelerId` was viewed.");

        return $this->respondWithData($traveler);
    }
}
