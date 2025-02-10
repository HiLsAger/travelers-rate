<?php

declare(strict_types=1);

namespace App\Application\Actions\Ratings;

use App\Domain\Cities\Cities;
use App\Domain\Ratings\Ratings;
use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Exceptions\ValidationException;

class AddRatingsAction extends RatingsAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        /**
         * @var Ratings $model
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
