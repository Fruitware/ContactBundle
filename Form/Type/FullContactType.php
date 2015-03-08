<?php

/*
 * This file is part of the Fruitware\ContactBundle Symfony bundle.
 *
 * (c) Coroliov Oleg <coroliov.o@fruitware.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fruitware\ContactBundle\Form\Type;

use Fruitware\ContactBundle\Provider\SubjectProviderInterface;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Contact type class
 *
 * @author Coroliov Oleg <coroliov.o@fruitware.ru>
 */
class FullContactType extends BaseContactType
{
    /**
     * @var SubjectProviderInterface
     */
    protected $subjectProvider;

    /**
     * Constructor
     *
     * @param SubjectProviderInterface $subjectProvider A subject provider instance
     * @param string                   $class           The Contact class namespace
     * @param string                   $captchaType     The captcha type
     */
    public function __construct(SubjectProviderInterface $subjectProvider, $class, $captchaType)
    {
        parent::__construct($class, $captchaType);

        $this->subjectProvider = $subjectProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('lastName',  'text',  array(
            'label' => 'fruitware_contact.form.last_name',
            'position' => array('after' => 'firstName')
        ));

        if ($subjects = $this->subjectProvider->getSubjects()) {
            $builder
                ->add('subject', 'choice', array(
                    'choices' => $subjects,
                    'label'   => 'fruitware_contact.form.subject',
                    'position' => array('before' => 'message')
                ));
        } else {
            $builder->add('subject', 'text', array(
                'label' => 'fruitware_contact.form.subject',
                'position' => array('before' => 'message')
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'fruitware_contact_full';
    }
}
