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

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Base Contact type class
 *
 * @author Coroliov Oleg <coroliov.o@fruitware.ru>
 */
class BaseContactType extends AbstractType
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @var string
     */
    protected $captchaType;

    /**
     * Constructor
     *
     * @param string                   $class           The Contact class namespace
     * @param string                   $captchaType     The captcha type
     */
    public function __construct($class, $captchaType)
    {
        $this->class           = $class;
        $this->captchaType     = $captchaType;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', 'text',  array('label' => 'fruitware_contact.form.first_name'))
            ->add('email',     'email', array('label' => 'fruitware_contact.form.email'));

        $builder->add('message', 'textarea', array('label' => 'fruitware_contact.form.message'));

        if ($this->captchaType) {
            $builder->add('captcha', $this->captchaType, array(
                'label'  => 'fruitware_contact.form.captcha',
                'mapped' => false
            ));
        }

        $builder->add('save', 'submit', array('label' => 'fruitware_contact.form_submit'));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => $this->class,
            'intention'          => 'contact',
            'translation_domain' => 'FruitwareContactBundle',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'fruitware_contact_base';
    }
}
