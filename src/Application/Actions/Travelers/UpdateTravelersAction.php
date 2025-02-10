<?php

declare(strict_types=1);

namespace App\Application\Actions\Travelers;

use App\Domain\Attractions\Attractions;
use App\Domain\Travelers\Travelers;
use Psr\Http\Message\ResponseInterface as Response;

class UpdateTravelersAction extends TravelersAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $id = (int)$this->resolveArg('id');
        /**
         * @var Travelers $model
         */
        $model = $this->repository->findModelOfId($id);

        if (empty($model)) {
            return $this->respondWithData(['Не существует путешественника'], 400);
        }

        $model->load($this->request->getParsedBody());
        $model->id = $id;

        if (!$model->validate()) {
            return $this->respondWithData($model->getErrors(), 400);
        }

        if (!$this->repository->updateRecord($model)) {
            return $this->respondWithData(['Не удалось обновить путешественника'], 400);
        }

        return $this->respondWithData(['id' => $model->id]);
    }
}
