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

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Form event class
 *
 * @author Coroliov Oleg <coroliov.o@fruitware.ru>
 */
class FormEvent extends Event
{
    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * Constructor
     *
     * @param FormInterface $form    A form instance
     * @param Request       $request A request instance
     */
    public function __construct(FormInterface $form, Request $request)
    {
        $this->form    = $form;
        $this->request = $request;
    }

    /**
     * Gets the form
     *
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->form;
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

    /**
     * Sets the response
     *
     * @param Response $response
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    /**
     * Gets the response
     *
     * @return Response|null
     */
    public function getResponse()
    {
        return $this->response;
    }
}
