<?php

declare(strict_types=1);

use App\Domain\Attractions\AttractionsRepository;
use App\Domain\Cities\CitiesRepository;
use App\Domain\Ratings\RatingsRepository;
use App\Domain\Travelers\TravelersRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        TravelersRepository::class => \DI\autowire(TravelersRepository::class),
        CitiesRepository::class => \DI\autowire(CitiesRepository::class),
        AttractionsRepository::class => \DI\autowire(AttractionsRepository::class),
        RatingsRepository::class => \DI\autowire(RatingsRepository::class),
    ]);
};
