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
        $id = (int) $this->resolveArg('id');
        $model = $this->repository->findUserOfId($id);

        $this->logger->info("Traveler of id `$id` was viewed.");

        return $this->respondWithData($model);
    }
}
