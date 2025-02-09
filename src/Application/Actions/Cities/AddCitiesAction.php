<?php

declare(strict_types=1);

namespace App\Application\Actions\Cities;

use App\Domain\Cities\Cities;
use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Exceptions\ValidationException;

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
        $model = $this->repository->load($this->request->getParsedBody());
        $model->id = null;

        if (!$model->validate()) {
            throw new ValidationException('Ошибка в данных');
        }

        if (!$id = $this->repository->insertRecord($model)) {
            throw new \Exception('Не удалось создать город');
        }

        return $this->respondWithData(['id' => $id]);
    }
}
