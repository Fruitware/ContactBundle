<?php

/*
 * This file is part of the Mremi\ContactBundle Symfony bundle.
 *
 * (c) Rémi Marseille <marseille.remi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mremi\ContactBundle\Event;

use Mremi\ContactBundle\Model\BaseContactInterface;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;

/**
 * Contact event class
 *
 * @author Rémi Marseille <marseille.remi@gmail.com>
 */
class ContactEvent extends Event
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var BaseContactInterface
     */
    private $contact;

    /**
     * Constructor
     *
     * @param BaseContactInterface $contact A contact instance
     * @param Request              $request A request instance
     */
    public function __construct(BaseContactInterface $contact, Request $request)
    {
        $this->contact = $contact;
        $this->request = $request;
    }

    /**
     * Gets the contact
     *
     * @return BaseContactInterface
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Gets the request
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }
}
