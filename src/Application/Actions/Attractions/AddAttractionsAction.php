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
         * @var Attractions $attraction
         */
        $model = $this->repository->load($this->request->getParsedBody());
        $model->id = null;

        if (!$attraction->validate()) {
            throw new ValidationException('Ошибка в данных');
        }


        if (!$id = $this->repository->insertRecord($model)) {
            throw new \Exception('Не удалось создать достопримечательность');
        }

        return $this->respondWithData(['id' => $id]);
    }
}
