<?php

/*
 * This file is part of the Fruitware\ContactBundle Symfony bundle.
 *
 * (c) Coroliov Oleg <coroliov.o@fruitware.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fruitware\ContactBundle\Mailer;

use Fruitware\ContactBundle\Model\BaseContactInterface;

/**
 * Mailer interface
 *
 * @author Coroliov Oleg <coroliov.o@fruitware.ru>
 */
interface MailerInterface
{
    /**
     * Sends an email
     *
     * @param BaseContactInterface $contact
     *
     * @return integer
     */
    public function sendMessage(BaseContactInterface $contact);
}
