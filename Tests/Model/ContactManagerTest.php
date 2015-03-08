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

use Fruitware\ContactBundle\Model\ContactManager;

/**
 * Tests ContactManager class
 *
 * @author Coroliov Oleg <coroliov.o@fruitware.ru>
 */
class ContactManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the create method
     */
    public function testCreate()
    {
        $contactManager = new ContactManager('Fruitware\ContactBundle\Model\Contact');

        $this->assertInstanceOf('Fruitware\ContactBundle\Model\Contact', $contactManager->create());
    }
}
