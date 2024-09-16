<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    // Inject the password encoder service
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    // Load the user fixture data into the database
    public function load(ObjectManager $manager)
    {
        // Create a new user entity
        $user = new User();
        $user->setEmail('user@example.com');
        $user->setRoles(['ROLE_USER']);

        // Encode the user's password
        $password = $this->passwordEncoder->encodePassword($user, 'password123');
        $user->setPassword($password);

        // Persist the user entity to the database
        $manager->persist($user);
        $manager->flush();
    }
}
