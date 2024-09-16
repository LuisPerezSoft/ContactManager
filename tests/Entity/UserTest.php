<?php

namespace App\Tests\Entity;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserTest extends KernelTestCase
{
    private $validator;

    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    // Setup the Symfony kernel and fetch the validator service
    protected function setUp(): void
    {
        self::bootKernel();
        $this->validator = self::$container->get(ValidatorInterface::class);
    }

    // Test the getters and setters of the User entity
    public function testGettersAndSetters(): void
    {
        $user = new User();

        // Test Email
        $email = 'user@example.com';
        $user->setEmail($email);
        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals($email, $user->getUsername());

        // Test Password
        $password = 'securepassword';
        $user->setPassword($password);
        $this->assertEquals($password, $user->getPassword());

        // Test Roles
        $roles = ['ROLE_ADMIN'];
        $user->setRoles($roles);
        $this->assertContains('ROLE_ADMIN', $user->getRoles());
        $this->assertContains('ROLE_USER', $user->getRoles());  // ROLE_USER should always be added
    }

    // Test that validation passes when valid data is provided
    public function testValidationSuccess(): void
    {
        $this->markTestSkipped('Skipping test due to SQLite compatibility issue with @UniqueEntity validation.');
        $user = new User();
        $user->setEmail('valid@example.com');
        $user->setPassword('strongpassword');

        // Validate the User entity
        $errors = $this->validator->validate($user);
        
        // Assert that there are no validation errors
        $this->assertCount(0, $errors);
    }

    // Test validation fails for invalid email and password
    public function testValidationFailure(): void
    {
        $this->markTestSkipped('Skipping test due to SQLite compatibility issue with @UniqueEntity validation.');

        $user = new User();
        $user->setEmail('invalid-email');  // Invalid email
        $user->setPassword('short');  // Too short password

        // Validate the User entity
        $errors = $this->validator->validate($user);

        // Expecting 2 errors (invalid email and password length)
        $this->assertCount(2, $errors);
    }

    // Test that email validation fails for blank email
    public function testBlankEmailValidation(): void
    {
        $this->markTestSkipped('Skipping test due to SQLite compatibility issue with @UniqueEntity validation.');

        $user = new User();
        $user->setEmail('');  // Blank email
        $user->setPassword('validpassword');

        // Validate the User entity
        $errors = $this->validator->validate($user);

        // There should be an error for blank email
        $this->assertGreaterThanOrEqual(1, count($errors));
    }

    // Test that password validation fails when it's too short
    public function testShortPasswordValidation(): void
    {
        $this->markTestSkipped('Skipping test due to SQLite compatibility issue with @UniqueEntity validation.');

        $user = new User();
        $user->setEmail('user@example.com');
        $user->setPassword('123');  // Too short

        // Validate the User entity
        $errors = $this->validator->validate($user);

        // There should be an error for short password
        $this->assertGreaterThanOrEqual(1, count($errors));
    }

    // Test the getSalt method (returns null as expected)
    public function testGetSalt(): void
    {
        $user = new User();
        $this->assertNull($user->getSalt());
    }

    // Test the eraseCredentials method (no sensitive data stored)
    public function testEraseCredentials(): void
    {
        $user = new User();
        $user->eraseCredentials();

        // Since eraseCredentials doesn't do anything currently, we just ensure it doesn't cause errors
        $this->assertTrue(true);
    }
}
