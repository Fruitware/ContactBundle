<?php

/*
 * This file is part of the Mremi\ContactBundle Symfony bundle.
 *
 * (c) Rémi Marseille <marseille.remi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mremi\ContactBundle\Mailer;

use Mremi\ContactBundle\Model\BaseContactInterface;

/**
 * Mailer interface
 *
 * @author Rémi Marseille <marseille.remi@gmail.com>
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
