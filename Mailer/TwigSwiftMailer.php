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
 * Twig Swift mailer class
 *
 * @author Coroliov Oleg <coroliov.o@fruitware.ru>
 */
class TwigSwiftMailer implements MailerInterface
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var string
     */
    private $recipientAddress;

    /**
     * @var string
     */
    private $template;

    /**
     * Constructor
     *
     * @param \Swift_Mailer     $mailer           A mailer instance
     * @param \Twig_Environment $twig             A Twig instance
     * @param string            $recipientAddress The recipient email
     * @param string            $template         The template used for email content
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, $recipientAddress, $template)
    {
        $this->mailer           = $mailer;
        $this->twig             = $twig;
        $this->recipientAddress = $recipientAddress;
        $this->template         = $template;
    }

    /**
     * {@inheritdoc}
     */
    public function sendMessage(BaseContactInterface $contact)
    {
        $context = array(
            'contact' => $contact,
        );

        $template = $this->twig->loadTemplate($this->template);
        $subject = method_exists($contact, 'getSubject') ? $contact->getSubject() : $template->renderBlock('default_subject', []);
        $textBody = $template->renderBlock('body_text', $context);
        $htmlBody = $template->renderBlock('body_html', $context);


        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($contact->getEmail(), $contact->getFullName())
            ->setTo($this->recipientAddress);

        if (!empty($htmlBody)) {
            $message->setBody($htmlBody, 'text/html')
                ->addPart($textBody, 'text/plain');
        } else {
            $message->setBody($textBody);
        }

        return $this->mailer->send($message);
    }
}
