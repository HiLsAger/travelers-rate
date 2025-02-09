<?php

declare(strict_types=1);

use App\Domain\User\TravelersRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        TravelersRepository::class => \DI\autowire(\App\Domain\Travelers\TravelersRepository::class),
    ]);
};
