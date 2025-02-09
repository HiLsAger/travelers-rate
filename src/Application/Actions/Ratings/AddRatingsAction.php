<?php

declare(strict_types=1);

namespace App\Application\Actions\Ratings;

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
        $model = $this->repository->load($this->request->getParsedBody());
        $model->id = null;

        if (!$model->validate()) {
            throw new ValidationException('Ошибка в данных');
        }

        if (!$id = $this->repository->insertRecord($model)) {
            throw new \Exception('Не удалось создать рейтинг');
        }

        return $this->respondWithData(['id' => $id]);
    }
}
