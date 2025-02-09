<?php

declare(strict_types=1);

namespace App\Application\Actions\Attractions;

use App\Domain\Attractions\Attractions;
use Psr\Http\Message\ResponseInterface as Response;

class UpdateAttractionsAction extends AttractionsAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        /**
         * @var Attractions $model
         */
        $model = $this->repository->load($this->request->getParsedBody());
        $model->id = (int)$this->resolveArg('id');


        $this->repository->updateRecord($model);

        return $this->respondWithData(['id' => $model->id]);
    }
}
