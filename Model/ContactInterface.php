<?php

/*
 * This file is part of the Fruitware\ContactBundle Symfony bundle.
 *
 * (c) Rémi Marseille <marseille.remi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fruitware\ContactBundle\Model;

/**
 * Contact interface
 *
 * @author Rémi Marseille <marseille.remi@gmail.com>
 */
interface ContactInterface extends BaseContactInterface
{
    /**
     * Sets the email address
     *
     * @param string $email
     */
    public function setEmail($email);

    /**
     * Gets the email address
     *
     * @return string
     */
    public function getEmail();

    /**
     * Sets the first name
     *
     * @param string $firstName
     */
    public function setFirstName($firstName);

    /**
     * Gets the first name
     *
     * @return string
     */
    public function getFirstName();

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
     * Gets the first name concatenated to the last name
     *
     * @return string
     */
    public function getFullName();

    /**
     * Sets the message
     *
     * @param string $message
     */
    public function setMessage($message);

    /**
     * Gets the message
     *
     * @return string
     */
    public function getMessage();

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
