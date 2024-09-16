<?php

namespace App\Tests\Form;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Form\Test\TypeTestCase;

class ContactTypeTest extends TypeTestCase
{
    public function testSubmitValidData(): void
    {
        // Test case with valid data for all fields
        $formData = [
            'name'  => 'Ramon Valdez',  // Valid name
            'email' => 'ramon.valdez@example.com',  // Valid email
            'phone' => '+1234567890',  // Valid phone number
        ];

        $model = new Contact(); // Contact entity

        // Create the form and submit the valid data
        $form = $this->factory->create(ContactType::class, $model);
        $form->submit($formData);

        // Ensure the form is synchronized with the entity
        $this->assertTrue($form->isSynchronized());

        // Check that the form correctly updates the entity
        $expected = new Contact();
        $expected->setName('Ramon Valdez');
        $expected->setEmail('ramon.valdez@example.com');
        $expected->setPhone('+1234567890');

        $this->assertEquals($expected, $model);
    }

    public function testSubmitMissingPhone(): void
    {
        // Test case where the phone number is optional (null)
        $formData = [
            'name'  => 'Ramon Valdez',  // Valid name
            'email' => 'ramon.valdez@example.com',  // Valid email
            'phone' => null,  // Phone number is not required
        ];

        $model = new Contact();

        // Create the form and submit the valid data
        $form = $this->factory->create(ContactType::class, $model);
        $form->submit($formData);

        // Ensure the form is valid even without a phone number
        $this->assertTrue($form->isValid());

        // Check that the form correctly updates the entity
        $expected = new Contact();
        $expected->setName('Ramon Valdez');
        $expected->setEmail('ramon.valdez@example.com');
        $expected->setPhone(null);  // Phone remains null

        $this->assertEquals($expected, $model);
    }

    public function testSubmitWithNullPhone(): void
    {
        // Test case where the phone is explicitly null
        $formData = [
            'name'  => 'Ramon Valdez',  // Valid name
            'email' => 'ramon.valdez@example.com',  // Valid email
            'phone' => null,  // Null phone
        ];

        $model = new Contact();

        // Create the form and submit the valid data (phone is nullable)
        $form = $this->factory->create(ContactType::class, $model);
        $form->submit($formData);

        // Ensure the form is valid even with a null phone number
        $this->assertTrue($form->isValid());

        // Check that the form correctly updates the entity
        $expected = new Contact();
        $expected->setName('Ramon Valdez');
        $expected->setEmail('ramon.valdez@example.com');
        $expected->setPhone(null);  // Phone is null

        $this->assertEquals($expected, $model);
    }
}
