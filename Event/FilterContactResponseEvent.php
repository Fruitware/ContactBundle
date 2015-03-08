<?php

/*
 * This file is part of the Fruitware\ContactBundle Symfony bundle.
 *
 * (c) Coroliov Oleg <coroliov.o@fruitware.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fruitware\ContactBundle\Event;

use Fruitware\ContactBundle\Model\BaseContactInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Filter contact response event class
 *
 * @author Coroliov Oleg <coroliov.o@fruitware.ru>
 */
class FilterContactResponseEvent extends ContactEvent
{
    /**
     * @var Response
     */
    protected $response;

    /**
     * Constructor
     *
     * @param ContactInterface $contact  A contact instance
     * @param Request          $request  A request instance
     * @param Response         $response A response instance
     */
    public function __construct(BaseContactInterface $contact, Request $request, Response $response)
    {
        parent::__construct($contact, $request);

        $this->response = $response;
    }

    /**
     * Gets the response
     *
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}
