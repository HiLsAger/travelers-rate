<?php

declare(strict_types=1);

namespace App\Application\Actions\Travelers;

use Psr\Http\Message\ResponseInterface as Response;

class DeleteTravelersAction extends TravelersAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $id = (int) $this->resolveArg('id');

        if (!$this->repository->deleteRecord($id)) {
            return $this->respondWithData(['Не удалось удалить путешественника'], 400);
        }

        return $this->respondWithData(['id' => $id]);
    }
}
