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
 * BaseContact interface
 *
 * @author Thomas Kekeisen <thomas.kekeisen@socialbit.de>
 */
interface BaseContactInterface extends \Serializable
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
     * Gets the first name concatenated to the last name if exist
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
     * Sets the created at
     *
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * Gets the created at
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Gets an array representation
     *
     * @return array
     */
    public function toArray();

    /**
     * Loads the object by the given data
     *
     * @param array $data
     */
    public function fromArray(array $data);
}
