<?php

/*
 * This file is part of the Fruitware\ContactBundle Symfony bundle.
 *
 * (c) Coroliov Oleg <coroliov.o@fruitware.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fruitware\ContactBundle\Controller;

use Fruitware\ContactBundle\Form\Handler\ContactFormHandler;
use Fruitware\ContactBundle\Form\Handler\FormHandler;
use Fruitware\ContactBundle\Model\ContactManagerInterface;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Contact controller class
 *
 * @author Coroliov Oleg <coroliov.o@fruitware.ru>
 */
class ContactController
{
    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * @var ContactFormHandler
     */
    protected $formHandler;

    /**
     * @var ContactManagerInterface
     */
    protected $contactManager;

    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * Constructor
     *
     * @param FormInterface            $form            A contact form
     * @param ContactFormHandler       $formHandler     A contact form handler
     * @param ContactManagerInterface  $contactManager  A contact manager
     * @param FormHandler              $formHandler     A contact manager instance
     * @param RouterInterface          $router          A router instance
     * @param SessionInterface         $session         A session instance
     * @param EngineInterface          $templating      A templating instance
     */
    public function __construct(FormInterface $form, ContactFormHandler $formHandler, ContactManagerInterface $contactManager, RouterInterface $router, SessionInterface $session, EngineInterface $templating)
    {
        $this->formHandler    = $formHandler;
        $this->form           = $form;
        $this->contactManager = $contactManager;
        $this->router         = $router;
        $this->session        = $session;
        $this->templating     = $templating;
    }

    /**
     * Index action in charge to render the form
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $contact = $this->contactManager->create();

        $response = $this->formHandler->process($contact);
        if ($response instanceof Response) {
            $this->session->set('fruitware_contact_data', $contact);

            return $response;
        }

        return $this->templating->renderResponse('FruitwareContactBundle:Contact:index.html.twig', array(
            'form' => $this->form->createView(),
        ));
    }

    /**
     * Confirm action in charge to render a confirmation message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws AccessDeniedException If no contact stored in session
     */
    public function confirmAction()
    {
        $contact = $this->session->get('fruitware_contact_data');
        $this->session->remove('fruitware_contact_data');

        if (!$contact) {
            return new RedirectResponse($this->router->generate('fruitware_contact_form'));
        }

        return $this->templating->renderResponse('FruitwareContactBundle:Contact:confirm.html.twig', array(
            'contact' => $contact,
        ));
    }
}
