<?php

/*
 * This file is part of the Fruitware\ContactBundle Symfony bundle.
 *
 * (c) Coroliov Oleg <coroliov.o@fruitware.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fruitware\ContactBundle\EventListener;

use Fruitware\ContactBundle\ContactEvents;
use Fruitware\ContactBundle\Event\FormEvent;
use Fruitware\ContactBundle\Mailer\MailerInterface;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Email confirmation listener class
 *
 * @author Coroliov Oleg <coroliov.o@fruitware.ru>
 */
class EmailConfirmationListener implements EventSubscriberInterface
{
    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * Constructor
     *
     * @param MailerInterface       $mailer A mailer instance
     * @param UrlGeneratorInterface $router An URL generator instance
     */
    public function __construct(MailerInterface $mailer, UrlGeneratorInterface $router)
    {
        $this->mailer = $mailer;
        $this->router = $router;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            ContactEvents::FORM_SUCCESS => 'onSubmitSuccess',
        );
    }

    /**
     * Called when the form is submitted successfully.
     * Sends a confirmation email and sets the event response.
     *
     * @param FormEvent $event A form event instance
     */
    public function onSubmitSuccess(FormEvent $event)
    {
        $this->mailer->sendMessage($event->getForm()->getData());

        $url = $this->router->generate('fruitware_contact_confirmation');

        $event->setResponse(new RedirectResponse($url));
    }
}
