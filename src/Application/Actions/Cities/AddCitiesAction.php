<?php

declare(strict_types=1);

namespace App\Application\Actions\Cities;

use App\Domain\Cities\Cities;
use Psr\Http\Message\ResponseInterface as Response;

class AddCitiesAction extends CitiesAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        /**
         * @var Cities $model
         */
        $model = $this->repository->load($this->request->getParsedBody() ?? []);
        $model->id = null;

        if (!$model->validate()) {
            return $this->respondWithData($model->getErrors(), 400);
        }

        if (!$id = $this->repository->insertRecord($model)) {
            return $this->respondWithData(['Не удалось создать город'], 400);
        }

        return $this->respondWithData(['id' => $id]);
    }
}
