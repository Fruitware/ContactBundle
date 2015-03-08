<?php

/*
 * This file is part of the Fruitware\ContactBundle Symfony bundle.
 *
 * (c) Coroliov Oleg <coroliov.o@fruitware.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fruitware\ContactBundle\Entity;

use Doctrine\Common\Persistence\ObjectManager;

use Fruitware\ContactBundle\Model\BaseContactInterface;
use Fruitware\ContactBundle\Model\ContactManager as BaseContactManager;

/**
 * Contact manager class
 *
 * @author Coroliov Oleg <coroliov.o@fruitware.ru>
 */
class ContactManager extends BaseContactManager
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * Constructor
     *
     * @param string        $class         The Contact class namespace
     * @param ObjectManager $objectManager An object manager instance
     */
    public function __construct($class, ObjectManager $objectManager)
    {
        parent::__construct($class);

        $this->objectManager = $objectManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(BaseContactInterface $contact, $flush = false)
    {
        $this->objectManager->persist($contact);

        if ($flush) {
            $this->objectManager->flush();
        }
    }
}
