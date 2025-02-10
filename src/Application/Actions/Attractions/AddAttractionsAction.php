<?php

declare(strict_types=1);

namespace App\Application\Actions\Attractions;

use App\Domain\Attractions\Attractions;
use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Exceptions\ValidationException;

class AddAttractionsAction extends AttractionsAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        /**
         * @var Attractions $model
         */
        $model = $this->repository->load($this->request->getParsedBody() ?? []);
        $model->id = null;

        if (!$model->validate()) {
            return $this->respondWithData($model->getErrors(), 400);
        }

        if (!$id = $this->repository->insertRecord($model)) {
            return $this->respondWithData(['Не удалось создать достопримечательность'], 400);
        }

        return $this->respondWithData(['id' => $id]);
    }
}
