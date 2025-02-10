<?php

declare(strict_types=1);

namespace App\Domain\Attractions;

use App\Application\Validators\IdExist;
use App\Domain\Model;
use JsonSerializable;
use Respect\Validation\Validator;

class Attractions extends Model implements JsonSerializable
{
    public ?int $id;

    public ?string $name;

    public ?int $distance_from_center;

    public ?int $city_id;

    public function __construct(
        ?int $id = null,
        string $name = '',
        int $distance_from_center = null,
        int $city_id = null
    ) {
        $this->id = $id;
        $this->name = strtolower($name);
        $this->distance_from_center = $distance_from_center;
        $this->city_id = $city_id;
    }

    public function getRules()
    {
        return [
            'name' => Validator::stringVal()->notBlank()->length(null, 255),
            'distance_from_center' => Validator::numericVal(),
            'city_id' => Validator::numericVal()->notBlank()->oneOf(
                new IdExist('cities')
            )
        ];
    }

    public static function getFilters(): array
    {
        return [
            'city_id' => 'city_id = :city_id'
        ];
    }

    public static function getCondition(string $filter): ?string
    {
        return self::getFilters()[$filter] ?? null;
    }

    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function getName(): ?string
    {
        return $this->name ?? null;
    }

    public function getDistanceFromCenter(): ?int
    {
        return $this->distance_from_center ?? null;
    }

    public function getCityId(): ?int
    {
        return $this->city_id ?? null;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'distance_from_center' => $this->getDistanceFromCenter(),
            'city_id' => $this->getCityId(),
        ];
    }
}
