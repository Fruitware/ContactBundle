<?php

namespace Mremi\ContactBundle\Block;

use Mremi\ContactBundle\ContactEvents;
use Mremi\ContactBundle\Event\ContactEvent;
use Mremi\ContactBundle\Event\FilterContactResponseEvent;
use Mremi\ContactBundle\Event\FormEvent;
use Mremi\ContactBundle\Form\Factory\FormFactory;
use Mremi\ContactBundle\Model\ContactManagerInterface;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\DependencyInjection\Container;

/**
 * Description of ContactBlockService
 *
 * @author thomas.kekeisen
 */
class ContactBlockService extends BaseBlockService
{
    /**
     * @var type Container
     */
    private $container;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var FormFactory
     */
    private $formFactory;

    /**
     * @var ContactManagerInterface
     */
    private $contactManager;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * Constructor
     *
     * @param EventDispatcherInterface $eventDispatcher An event dispatcher instance
     * @param FormFactory              $formFactory     A form factory instance
     * @param ContactManagerInterface  $contactManager  A contact manager instance
     * @param RouterInterface          $router          A router instance
     * @param SessionInterface         $session         A session instance
     */
    public function __construct($name, EngineInterface $templating, Container $container, EventDispatcherInterface $eventDispatcher, FormFactory $formFactory, ContactManagerInterface $contactManager, RouterInterface $router, SessionInterface $session)
    {
        $this->container       = $container;
        $this->eventDispatcher = $eventDispatcher;
        $this->formFactory     = $formFactory;
        $this->contactManager  = $contactManager;
        $this->name            = $name;
        $this->router          = $router;
        $this->session         = $session;
        $this->templating      = $templating;
    }

    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        $keys = array(
        );

        $form = array('keys' => $keys);

        $formMapper->add('settings', 'sonata_type_immutable_array', $form);
    }

    public function execute (BlockContextInterface $blockContext, Response $response = null)
    {
        $settings = $blockContext->getSettings();

        $request = $this->container->get('request');

        $contact = $this->contactManager->create();

        $this->eventDispatcher->dispatch(ContactEvents::FORM_INITIALIZE, new ContactEvent($contact, $request));

        $form = $this->formFactory->createForm($contact);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $this->eventDispatcher->dispatch(ContactEvents::FORM_SUCCESS, $event);

            if (null === $response = $event->getResponse()) {
                $response = new RedirectResponse($request->get('_route'));
            }

            $this->contactManager->save($contact, true);
            $this->session->set('mremi_contact_data', $contact);

            $this->eventDispatcher->dispatch(ContactEvents::FORM_COMPLETED, new FilterContactResponseEvent($contact, $request, $response));

            return $response;
        }

        return $this->renderResponse($blockContext->getTemplate(), array(
            'block'    => $blockContext->getBlock(),
            'form'     => $form->createView(),
            'settings' => $settings
        ), $response);
    }

    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $defaults = array(
            'template'  => 'MremiContactBundle:Contact:block.html.twig',
        );

        $resolver->setDefaults($defaults);
    }

    public function getName()
    {
        return 'Contact';
    }
}
