<?php

declare(strict_types=1);

namespace App\Application\Actions\Cities;

use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Exceptions\ValidationException;

class AddCitiesAction extends CitiesAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $city = $this->citiesRepository->load($this->request->getParsedBody());

        if (!$city->validate()) {
            throw new ValidationException('Ошибка в данных');
        }

        if (!$city->getId()) {
            if (!$id = $this->citiesRepository->insertRecord($city)) {
                throw new \Exception('Не удалось создать путешественника');
            }

            return $this->respondWithData(['id' => $id]);
        }

        if (!$id = $this->citiesRepository->insertRecord($city)) {
            throw new \Exception('Не удалось обновить путешественника');
        }

        return $this->respondWithData(['id' => $id]);
    }
}
