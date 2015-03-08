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
 * Contact interface
 *
 * @author Coroliov Oleg <coroliov.o@fruitware.ru>
 */
interface ContactInterface extends BaseContactInterface
{
    /**
     * Sets the last name
     *
     * @param string $lastName
     */
    public function setLastName($lastName);

    /**
     * Gets the last name
     *
     * @return string
     */
    public function getLastName();

    /**
     * Sets the subject
     *
     * @param string $subject
     */
    public function setSubject($subject);

    /**
     * Gets the subject
     *
     * @return string
     */
    public function getSubject();
}
