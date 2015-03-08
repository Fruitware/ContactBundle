<?php

/*
 * This file is part of the Fruitware\ContactBundle Symfony bundle.
 *
 * (c) Rémi Marseille <marseille.remi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fruitware\ContactBundle;

/**
 * Contains all events thrown in the FruitwareContactBundle
 *
 * @author Rémi Marseille <marseille.remi@gmail.com>
 */
final class ContactEvents
{
    /**
     * The FORM_INITIALIZE event occurs when the form is initialized.
     *
     * This event allows you to modify the default values of the contact before binding the form.
     * The event listener method receives a Fruitware\ContactBundle\Event\GetResponseContactEvent instance.
     */
    const FORM_INITIALIZE = 'fruitware_contact.form.initialize';

    /**
     * The FORM_SUCCESS event occurs when the form is submitted successfully.
     *
     * This event allows you to set the response instead of using the default one.
     * The event listener method receives a Fruitware\ContactBundle\Event\FormEvent instance.
     */
    const FORM_SUCCESS = 'fruitware_contact.form.success';

    /**
     * The FORM_COMPLETED event occurs after saving the contact in the contact form process.
     *
     * This event allows you to access the response which will be sent.
     * The event listener method receives a Fruitware\ContactBundle\Event\FilterUserResponseEvent instance.
     */
    const FORM_COMPLETED = 'fruitware_contact.form.completed';
}
