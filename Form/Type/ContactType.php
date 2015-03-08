<?php

/*
 * This file is part of the Fruitware\ContactBundle Symfony bundle.
 *
 * (c) Rémi Marseille <marseille.remi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fruitware\ContactBundle\Form\Type;

use Fruitware\ContactBundle\Model\Contact;
use Fruitware\ContactBundle\Provider\SubjectProviderInterface;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Contact type class
 *
 * @author Rémi Marseille <marseille.remi@gmail.com>
 */
class ContactType extends AbstractType
{
    /**
     * @var SubjectProviderInterface
     */
    private $subjectProvider;

    /**
     * @var string
     */
    private $class;

    /**
     * @var string
     */
    private $captchaType;

    /**
     * Constructor
     *
     * @param SubjectProviderInterface $subjectProvider A subject provider instance
     * @param string                   $class           The Contact class namespace
     * @param string                   $captchaType     The captcha type
     */
    public function __construct(SubjectProviderInterface $subjectProvider, $class, $captchaType)
    {
        $this->subjectProvider = $subjectProvider;
        $this->class           = $class;
        $this->captchaType     = $captchaType;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'choice', array(
                'choices'  => Contact::getTitles(),
                'expanded' => true,
                'label'    => 'fruitware_contact.form.title',
            ))
            ->add('firstName', 'text',  array('label' => 'fruitware_contact.form.first_name'))
            ->add('lastName',  'text',  array('label' => 'fruitware_contact.form.last_name'))
            ->add('email',     'email', array('label' => 'fruitware_contact.form.email'));

        if ($subjects = $this->subjectProvider->getSubjects()) {
            $builder
                ->add('subject', 'choice', array(
                    'choices' => $subjects,
                    'label'   => 'fruitware_contact.form.subject',
                ));
        } else {
            $builder->add('subject', 'text', array('label' => 'fruitware_contact.form.subject'));
        }

        $builder->add('message', 'textarea', array('label' => 'fruitware_contact.form.message'));

        if ($this->captchaType) {
            $builder->add('captcha', $this->captchaType, array(
                'label'  => 'fruitware_contact.form.captcha',
                'mapped' => false,
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
        return 'fruitware_contact';
    }
}
