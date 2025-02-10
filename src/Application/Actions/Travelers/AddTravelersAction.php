<?php

declare(strict_types=1);

namespace App\Application\Actions\Travelers;

use App\Domain\Attractions\Attractions;
use App\Domain\Travelers\Travelers;
use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Exceptions\ValidationException;

class AddTravelersAction extends TravelersAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        /**
         * @var Travelers $model
         */
        $model = $this->repository->load($this->request->getParsedBody() ?? []);
        $model->id = null;

        if (!$model->validate()) {
            return $this->respondWithData($model->getErrors(), 400);
        }

        if (!$id = $this->repository->insertRecord($model)) {
            return $this->respondWithData(['Не удалось создать путешественника'], 400);
        }

        return $this->respondWithData(['id' => $id]);
    }
}
