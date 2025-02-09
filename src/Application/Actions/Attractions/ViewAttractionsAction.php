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
        $id = (int) $this->resolveArg('id');
        $model = $this->repository->findUserOfId($id);

        $this->logger->info("Attraction of id `$id` was viewed.");

        return $this->respondWithData($model);
    }
}
