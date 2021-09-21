<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setFirstname($faker->firstname())
                ->setLastname($faker->lastName)
                ->setPhoneNumber('034808081' . $i)
                ->setMoney($faker->numberBetween(0, 100000000))
                ->setPassword("mvolapassword")
                ->setBirthday($faker->dateTime('-18 years'));

            $manager->persist($user);
        }

        $manager->flush();
    }
}
