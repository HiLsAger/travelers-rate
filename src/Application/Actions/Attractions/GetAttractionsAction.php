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
        $attractions = $this->attractionsRepository->findAll();

        $this->logger->info("Attractions list was viewed.");

        return $this->respondWithData($attractions);
    }
}
