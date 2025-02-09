<?php

declare(strict_types=1);

use App\Domain\Cities\CitiesRepository;
use App\Domain\Travelers\TravelersRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        TravelersRepository::class => \DI\autowire(TravelersRepository::class),
        CitiesRepository::class => \DI\autowire(CitiesRepository::class),
    ]);
};
