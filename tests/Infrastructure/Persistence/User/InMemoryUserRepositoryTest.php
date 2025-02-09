<?php

declare(strict_types=1);

namespace Tests\Infrastructure\Persistence\User;

use App\Domain\User\Travelers;
use App\Domain\User\TravelersNotFoundException;
use App\Infrastructure\Persistence\User\InMemoryTravelersRepository;
use Tests\TestCase;

class InMemoryUserRepositoryTest extends TestCase
{
    public function testFindAll()
    {
        $user = new Travelers(1, 'bill.gates', 'Bill', 'Gates');

        $userRepository = new InMemoryTravelersRepository([1 => $user]);

        $this->assertEquals([$user], $userRepository->findAll());
    }

    public function testFindAllUsersByDefault()
    {
        $users = [
            1 => new Travelers(1, 'bill.gates', 'Bill', 'Gates'),
            2 => new Travelers(2, 'steve.jobs', 'Steve', 'Jobs'),
            3 => new Travelers(3, 'mark.zuckerberg', 'Mark', 'Zuckerberg'),
            4 => new Travelers(4, 'evan.spiegel', 'Evan', 'Spiegel'),
            5 => new Travelers(5, 'jack.dorsey', 'Jack', 'Dorsey'),
        ];

        $userRepository = new InMemoryTravelersRepository();

        $this->assertEquals(array_values($users), $userRepository->findAll());
    }

    public function testFindUserOfId()
    {
        $user = new Travelers(1, 'bill.gates', 'Bill', 'Gates');

        $userRepository = new InMemoryTravelersRepository([1 => $user]);

        $this->assertEquals($user, $userRepository->findUserOfId(1));
    }

    public function testFindUserOfIdThrowsNotFoundException()
    {
        $userRepository = new InMemoryTravelersRepository([]);
        $this->expectException(TravelersNotFoundException::class);
        $userRepository->findUserOfId(1);
    }
}
