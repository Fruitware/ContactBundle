<?php

namespace Fruitware\ContactBundle\Form\Handler;

use Fruitware\ContactBundle\ContactEvents;
use Fruitware\ContactBundle\Event\ContactEvent;
use Fruitware\ContactBundle\Event\FilterContactResponseEvent;
use Fruitware\ContactBundle\Event\FormEvent;
use Fruitware\ContactBundle\Model\BaseContactInterface;
use Fruitware\ContactBundle\Model\ContactManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;

class ContactFormHandler
{
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var ContactManagerInterface
     */
    protected $contactManager;
    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * @param FormInterface            $form
     * @param Request                  $request
     * @param RouterInterface          $router
     * @param ContactManagerInterface  $contactManager
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(FormInterface $form, ContactManagerInterface $contactManager, Request $request, RouterInterface $router, EventDispatcherInterface $eventDispatcher)
    {
        $this->form = $form;
        $this->request = $request;
        $this->router = $router;
        $this->contactManager = $contactManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param BaseContactInterface $contact
     *
     * @return bool
     */
    public function process(BaseContactInterface $contact)
    {
        $this->eventDispatcher->dispatch(ContactEvents::FORM_INITIALIZE, new ContactEvent($contact, $this->request));

        $this->form->setData($contact);

        if ('POST' == $this->request->getMethod()) {
            $this->form->bind($this->request);

            if ($this->form->isValid()) {
                $event = new FormEvent($this->form, $this->request);
                $this->eventDispatcher->dispatch(ContactEvents::FORM_SUCCESS, $event);

                if (null === $response = $event->getResponse()) {
                    $response = new RedirectResponse($this->router->generate('fruitware_contact_confirmation'));
                }

                $this->contactManager->save($contact);

                $this->eventDispatcher->dispatch(ContactEvents::FORM_COMPLETED, new FilterContactResponseEvent($contact, $this->request, $response));

                return $response;
            }
        }

        return false;
    }
}
