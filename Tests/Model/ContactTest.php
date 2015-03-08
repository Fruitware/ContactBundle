<?php

/*
 * This file is part of the Fruitware\ContactBundle Symfony bundle.
 *
 * (c) Coroliov Oleg <coroliov.o@fruitware.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fruitware\ContactBundle\Tests\Model;

use Fruitware\ContactBundle\Model\Contact;

/**
 * Tests Contact class
 *
 * @author Sparrow Jack <jack.sparrow@example.com>
 */
class ContactTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the createdAt property
     */
    public function testCreatedAt()
    {
        $contact = new Contact;

        $this->assertInstanceOf('\DateTime', $contact->getCreatedAt());
    }

    /**
     * Tests the getFullName method
     */
    public function testFullName()
    {
        $contact = new Contact;
        $contact->setFirstName('Jack');
        $contact->setLastName('Sparrow');

        $this->assertEquals('Jack Sparrow', $contact->getFullName());
    }

    /**
     * Tests the toArray method
     */
    public function testToArray()
    {
        $contact = new Contact;
        $contact->setFirstName('Jack');
        $contact->setLastName('Sparrow');
        $contact->setEmail('jack.sparrow@example.com');
        $contact->setSubject('subject');
        $contact->setMessage('message');
        $contact->setCreatedAt(new \DateTime('2014-03-09T10:01:00+02:00'));

        $expected = array(
            'firstName' => 'Jack',
            'lastName'  => 'Sparrow',
            'email'     => 'jack.sparrow@example.com',
            'subject'   => 'subject',
            'message'   => 'message',
            'createdAt' => '2014-03-09T10:01:00+02:00',
        );

        $this->assertEquals($expected, $contact->toArray());
    }

    /**
     * Tests the fromArray method
     */
    public function testFromArray()
    {
        $contact = new Contact;
        $contact->fromArray(array(
            'firstName' => 'Jack',
            'lastName'  => 'Sparrow',
            'email'     => 'jack.sparrow@example.com',
            'subject'   => 'subject',
            'message'   => 'message',
            'createdAt' => '2014-03-09T10:01:00+02:00',
        ));

        $this->assertEquals('Jack', $contact->getFirstName());
        $this->assertEquals('Sparrow', $contact->getLastName());
        $this->assertEquals('jack.sparrow@example.com', $contact->getEmail());
        $this->assertEquals('subject', $contact->getSubject());
        $this->assertEquals('message', $contact->getMessage());
        $this->assertEquals('2014-03-09T10:01:00+02:00', $contact->getCreatedAt()->format('c'));
    }

    /**
     * Tests the serialize method
     */
    public function testSerialize()
    {
        $contact = new Contact;
        $contact->setFirstName('Jack');
        $contact->setLastName('Sparrow');
        $contact->setEmail('jack.sparrow@example.com');
        $contact->setSubject('subject');
        $contact->setMessage('message');
        $contact->setCreatedAt(new \DateTime('2014-03-09T10:01:00+02:00'));

        $expected = 'a:6:{s:9:"firstName";s:4:"Jack";s:5:"email";s:24:"jack.sparrow@example.com";s:7:"message";s:7:"message";s:9:"createdAt";s:25:"2014-03-09T10:01:00+02:00";s:8:"lastName";s:7:"Sparrow";s:7:"subject";s:7:"subject";}';

        $this->assertEquals($expected, $contact->serialize());
    }

    /**
     * Tests the unserialize method
     */
    public function testUnserialize()
    {
        $contact = new Contact;
        $contact->unserialize('a:6:{s:9:"firstName";s:4:"Jack";s:5:"email";s:24:"jack.sparrow@example.com";s:7:"message";s:7:"message";s:9:"createdAt";s:25:"2014-03-09T10:01:00+02:00";s:8:"lastName";s:7:"Sparrow";s:7:"subject";s:7:"subject";}');

        $this->assertEquals('Jack', $contact->getFirstName());
        $this->assertEquals('Sparrow', $contact->getLastName());
        $this->assertEquals('jack.sparrow@example.com', $contact->getEmail());
        $this->assertEquals('subject', $contact->getSubject());
        $this->assertEquals('message', $contact->getMessage());
        $this->assertEquals('2014-03-09T10:01:00+02:00', $contact->getCreatedAt()->format('c'));
    }
}
