<?php

namespace App\Tests\Entity;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ContactTest extends KernelTestCase
{
    private $validator;

    // Overriding getKernelClass to specify the Kernel class manually
    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    // Set up the Symfony kernel and fetch the validator service
    protected function setUp(): void
    {
        self::bootKernel();
        $this->validator = self::$container->get(ValidatorInterface::class);
    }

    // Test the getters and setters of the Contact entity
    public function testGettersAndSetters(): void
    {
        $contact = new Contact();

        // Test Name getter and setter
        $name = 'John Doe';
        $contact->setName($name);
        $this->assertEquals($name, $contact->getName());

        // Test Email getter and setter
        $email = 'john@example.com';
        $contact->setEmail($email);
        $this->assertEquals($email, $contact->getEmail());

        // Test Phone getter and setter
        $phone = '+1234567890';
        $contact->setPhone($phone);
        $this->assertEquals($phone, $contact->getPhone());
    }

    // Test that validation passes when valid data is provided
    public function testValidationSuccess(): void
    {
        $contact = new Contact();
        $contact->setName('John Doe');
        $contact->setEmail('john@example.com');
        $contact->setPhone('+1234567890');

        // Validate the Contact entity
        $errors = $this->validator->validate($contact);

        // Assert that there are no validation errors
        $this->assertCount(0, $errors);
    }

    // Test that validation fails with invalid data (empty name, invalid email, invalid phone)
    public function testValidationFailure(): void
    {
        $contact = new Contact();
        $contact->setName('');  // Empty name
        $contact->setEmail('invalid-email');  // Invalid email
        $contact->setPhone('invalid-phone');  // Invalid phone number

        // Validate the Contact entity
        $errors = $this->validator->validate($contact);

        // Assert that there are 3 validation errors
        $this->assertCount(3, $errors);
    }

    // Test that validation fails when the name is blank
    public function testBlankNameValidation(): void
    {
        $contact = new Contact();
        $contact->setName('');  // Empty name
        $contact->setEmail('valid@example.com');
        $contact->setPhone('+1234567890');

        // Validate the Contact entity
        $errors = $this->validator->validate($contact);
        
        // Assert that there is at least 1 validation error (name)
        $this->assertGreaterThanOrEqual(1, count($errors));
    }

    // Test that validation fails when the email is invalid
    public function testInvalidEmailValidation(): void
    {
        $contact = new Contact();
        $contact->setName('John Doe');
        $contact->setEmail('invalid-email');  // Invalid email format
        $contact->setPhone('+1234567890');

        // Validate the Contact entity
        $errors = $this->validator->validate($contact);

        // Assert that there is at least 1 validation error (email)
        $this->assertGreaterThanOrEqual(1, count($errors));
    }

    // Test that validation fails when the phone number is invalid
    public function testInvalidPhoneValidation(): void
    {
        $contact = new Contact();
        $contact->setName('John Doe');
        $contact->setEmail('john@example.com');
        $contact->setPhone('invalid-phone');  // Invalid phone number format

        // Validate the Contact entity
        $errors = $this->validator->validate($contact);

        // Assert that there is at least 1 validation error (phone)
        $this->assertGreaterThanOrEqual(1, count($errors));
    }
}
