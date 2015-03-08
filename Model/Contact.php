<?php

/*
 * This file is part of the Fruitware\ContactBundle Symfony bundle.
 *
 * (c) Coroliov Oleg <coroliov.o@fruitware.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fruitware\ContactBundle\Model;

/**
 * Contact class
 *
 * @author Coroliov Oleg <coroliov.o@fruitware.ru>
 */
class Contact extends BaseContact implements ContactInterface
{
    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $subject;

    /**
     * {@inheritdoc}
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * {@inheritdoc}
     */
    public function getFullName()
    {
        return sprintf('%s %s', $this->firstName, $this->lastName);
    }

    /**
     * {@inheritdoc}
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        $baseArray = parent::toArray();

        return array_merge($baseArray, array(
            'lastName'  => $this->lastName,
            'subject'   => $this->subject,
        ));
    }
}
