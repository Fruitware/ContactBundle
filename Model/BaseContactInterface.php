<?php

/*
 * This file is part of the Mremi\ContactBundle Symfony bundle.
 *
 * (c) Rémi Marseille <marseille.remi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Mremi\ContactBundle\Model;

/**
 * BaseContact interface
 *
 * @author Thomas Kekeisen <thomas.kekeisen@socialbit.de>
 */
interface BaseContactInterface extends \Serializable
{
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
