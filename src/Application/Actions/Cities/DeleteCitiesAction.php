<?php

declare(strict_types=1);

namespace App\Application\Actions\Attractions;

use App\Application\Actions\Cities\CitiesAction;
use Psr\Http\Message\ResponseInterface as Response;

class DeleteCitiesAction extends CitiesAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $id = (int) $this->resolveArg('id');

        $this->repository->deleteRecord($id);

        return $this->respondWithData(['id' => $id]);
    }
}
