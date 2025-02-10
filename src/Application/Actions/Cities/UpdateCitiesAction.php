<?php

declare(strict_types=1);

namespace App\Application\Actions\Cities;

use App\Domain\Cities\Cities;
use Psr\Http\Message\ResponseInterface as Response;

class UpdateCitiesAction extends CitiesAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $id = (int)$this->resolveArg('id');
        /**
         * @var Cities $model
         */
        $model = $this->repository->findModelOfId($id);

        if (empty($model)) {
            return $this->respondWithData(['Не существует город'], 400);
        }

        $model->load($this->request->getParsedBody());
        $model->id = $id;

        if (!$model->validate()) {
            return $this->respondWithData($model->getErrors(), 400);
        }

        if (!$this->repository->updateRecord($model)) {
            return $this->respondWithData(['Не удалось обновить город'], 400);
        }

        return $this->respondWithData(['id' => $model->id]);
    }
}
