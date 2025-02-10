<?php

declare(strict_types=1);

namespace App\Domain\Ratings;

use App\Application\Validators\IdExist;
use App\Domain\Model;
use JsonSerializable;
use Respect\Validation\Validator;

class Ratings extends Model implements JsonSerializable
{
    public ?int $id;

    public ?int $traveler_id;

    public ?int $attraction_id;

    public ?int $score;

    public function __construct(
        ?int $id = null,
        int $traveler_id = null,
        int $attraction_id = null,
        int $score = null
    ) {
        $this->id = $id;
        $this->traveler_id = $traveler_id;
        $this->attraction_id = $attraction_id;
        $this->score = $score;
    }

    public function getRules()
    {
        return [
            'traveler_id' => Validator::numericVal()->notBlank()->oneOf(
                new IdExist('traveler')
            ),
            'attraction_id' => Validator::numericVal()->notBlank()->oneOf(
                new IdExist('attraction')
            ),
            'score' => Validator::numericVal()->notBlank()->length(1, 5)
        ];
    }

    public static function getFilters(): array
    {
        return [
            'min_rating' => 'score'
        ];
    }

    public static function getFilter(string $filter): ?string
    {
        return in_array($filter, self::getFilters()) ? self::getFilters()[$filter] : null;
    }

    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function getTravelerId(): ?int
    {
        return $this->traveler_id ?? null;
    }

    public function getAttractionId(): ?int
    {
        return $this->attraction_id ?? null;
    }

    public function getScore(): ?int
    {
        return $this->score ?? null;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'traveler_id' => $this->getTravelerId(),
            'attraction_id' => $this->getAttractionId(),
            'score' => $this->getScore(),
        ];
    }
}
