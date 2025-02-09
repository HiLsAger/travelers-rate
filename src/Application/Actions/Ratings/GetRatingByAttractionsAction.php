<?php

declare(strict_types=1);

namespace App\Application\Actions\Ratings;

use Psr\Http\Message\ResponseInterface as Response;

class GetRatingByAttractionsAction extends RatingsAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $id = (int)$this->resolveArg('id');
        $model = $this->repository->getRatingByAttractions($id);

        return $this->respondWithData($model);
    }
}
