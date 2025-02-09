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
        $traveler = $this->travelersRepository->loadTraveler($this->request->getParsedBody());

        if (!$traveler->validate()) {
            throw new ValidationException('Ошибка в данных');
        }

        if (!$traveler->getId()) {
            if (!$id = $this->travelersRepository->insertRecord($traveler)) {
                throw new \Exception('Не удалось создать путешественника');
            }

            return $this->respondWithData(['id' => $id]);
        }

        if (!$id = $this->travelersRepository->insertRecord($traveler)) {
            throw new \Exception('Не удалось обновить путешественника');
        }

        return $this->respondWithData(['id' => $id]);
    }
}
