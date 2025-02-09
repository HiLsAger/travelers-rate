<?php

declare(strict_types=1);

namespace App\Domain\Cities;

use App\Domain\Model;
use JsonSerializable;
use Respect\Validation\Validator;

class Cities extends Model implements JsonSerializable
{
    public ?int $id;

    public string $name;

    public function __construct(?int $id = null, string $name = '')
    {
        $this->id = $id;
        $this->name = strtolower($name);
    }

    public function getRules()
    {
        return [
            'name' => Validator::stringVal()->notBlank()->length(null, 255),
        ];
    }

    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function getName(): ?string
    {
        return $this->name ?? null;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
        ];
    }
}
