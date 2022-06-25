<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
// use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;
    // public function __construct(UserPasswordEncoderInterface $encoder)
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $user = new User();

        $user->setFirstname('admin')
            ->setLastname('admin')
            ->setPhoneNumber('0340011122')
            ->setMoney('0')
            ->setBirthday(new \DateTime("1999-09-01"))
            ->setPassword("adminpw")
            ->setRoles(["ROLE_ADMIN"]);

        // $user->setPassword($this->encoder->encodePassWord($user, $user->getPassword()));
        $user->setPassword($this->encoder->hashPassword(
            $user,
            $user->getPassword()
        ));

        $manager->persist($user);

        $manager->flush();
    }
}
