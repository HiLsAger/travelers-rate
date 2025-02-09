<?php

declare(strict_types=1);

namespace App\Application\Actions\Travelers;

use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Exceptions\ValidationException;

class AddTravelersAction extends TravelersAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $model = $this->repository->loadTraveler($this->request->getParsedBody());

        if (!$model->validate()) {
            throw new ValidationException('Ошибка в данных');
        }

        if (!$id = $this->travelersRepository->insertRecord($model)) {
            throw new \Exception('Не удалось создать путешественника');
        }

        return $this->respondWithData(['id' => $id]);
    }
}
