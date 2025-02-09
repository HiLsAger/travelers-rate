<?php

declare(strict_types=1);

namespace App\Application\Actions\Ratings;

use Psr\Http\Message\ResponseInterface as Response;

class GetRatingByTravelersAction extends RatingsAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $id = (int)$this->resolveArg('id');
        $model = $this->repository->getRatingByTravelers($id);

        return $this->respondWithData($model);
    }
}
