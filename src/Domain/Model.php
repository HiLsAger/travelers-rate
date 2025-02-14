<?php

namespace App\Domain;

use Respect\Validation\ChainedValidator;

class Model
{
    protected array $errors = [];

    public function getRules()
    {
        return [];
    }

    public static function getFilters(): array
    {
        return [];
    }

    public static function getCondition(string $filter): ?string
    {
        return self::getFilters()[$filter] ?? null;
    }

    public function load($data): bool
    {
        foreach ($data as $property => $value) {
            if (!property_exists($this, $property)) {
                throw new \Exception("Неизвестный аргумент $property");
            }

            $this->{$property} = $value;
        }

        return $this->validate();
    }


    public function getErrors(): array
    {
        return $this->errors;
    }

    public function validate(): bool
    {
        $this->errors = [];

        /**
         * @var ChainedValidator $rule
         */
        foreach ($this->getRules() as $attr => $rule) {
            if (!$rule->validate($this->{$attr})) {
                $this->errors[] = "Ошибка в свойстве $attr";
            }
        }

        if ($this->getErrors()) {
            return false;
        }

        return true;
    }
}