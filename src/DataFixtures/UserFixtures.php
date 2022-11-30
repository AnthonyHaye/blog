<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('hs');
        $user->setPassword('$2y$13$H7P/WBm00qb3xiXlHO2tluMxW6FFxmj6HUAQPgMSzjG8Ri7mXOEgS');

        $manager->persist($user);

        $admin = new User();
        $admin->setUsername('hs2');
        $admin->setPassword('$2y$13$cnnvDE7E9joyMXn78HgX.Ohy9FQLW2zSGP9gKZMadqnyDsL/R55w6');
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $admin = new User();
        $admin->setUsername('1');
        $admin->setPassword('$2y$13$cnnvDE7E9joyMXn78HgX.Ohy9FQLW2zSGP9gKZMadqnyDsL/R55w6');
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $admin = new User();
        $admin->setUsername('2');
        $admin->setPassword('$2y$13$cnnvDE7E9joyMXn78HgX.Ohy9FQLW2zSGP9gKZMadqnyDsL/R55w6');
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $manager->flush();
    }
}
