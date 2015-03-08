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
 * Contact manager interface
 *
 * @author Coroliov Oleg <coroliov.o@fruitware.ru>
 */
interface ContactManagerInterface
{
    /**
     * Creates and returns a new contact instance
     *
     * @return BaseContactInterface
     */
    public function create();

    /**
     * Saves the given contact in configured storage system
     *
     * @param BaseContactInterface $contact A contact instance
     * @param boolean              $flush   TRUE whether you want to synchronize with the database
     */
    public function save(BaseContactInterface $contact, $flush = true);
}
