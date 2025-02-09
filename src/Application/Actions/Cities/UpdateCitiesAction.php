<?php

declare(strict_types=1);

namespace App\Application\Actions\Attractions;

use App\Application\Actions\Cities\CitiesAction;
use App\Domain\Attractions\Attractions;
use App\Domain\Cities\Cities;
use Psr\Http\Message\ResponseInterface as Response;

class UpdateCitiesAction extends CitiesAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        /**
         * @var Cities $model
         */
        $model = $this->repository->load($this->request->getParsedBody());
        $model->id = (int)$this->resolveArg('id');


        $this->repository->updateRecord($model);

        return $this->respondWithData(['id' => $model->id]);
    }
}
