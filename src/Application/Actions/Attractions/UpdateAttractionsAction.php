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
        $id = (int)$this->resolveArg('id');
        /**
         * @var Attractions $model
         */
        $model = $this->repository->findModelOfId($id);

        if (empty($model)) {
            return $this->respondWithData(['Не существует достопримечательности'], 400);
        }

        $model->load($this->request->getParsedBody());
        $model->id = $id;

        if (!$model->validate()) {
            return $this->respondWithData($model->getErrors(), 400);
        }

        if (!$this->repository->updateRecord($model)) {
            return $this->respondWithData(['Не удалось обновить достопримечательность'], 400);
        }

        return $this->respondWithData(['id' => $model->id]);
    }
}
