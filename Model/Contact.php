<?php

/*
 * This file is part of the Fruitware\ContactBundle Symfony bundle.
 *
 * (c) Rémi Marseille <marseille.remi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fruitware\ContactBundle\Model;

/**
 * Contact class
 *
 * @author Rémi Marseille <marseille.remi@gmail.com>
 */
class Contact extends BaseContact implements ContactInterface
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $message;

    /**
     * {@inheritdoc}
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * {@inheritdoc}
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * {@inheritdoc}
     */
    public function getFullName()
    {
        return sprintf('%s %s', $this->firstName, $this->lastName);
    }

    /**
     * {@inheritdoc}
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * {@inheritdoc}
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle($title)
    {
        $validTitles = self::getTitleKeys();

        if (!in_array($title, $validTitles)) {
            throw new \InvalidArgumentException(sprintf('Invalid title %s, possible values are: %s', $title, implode(', ', $validTitles)));
        }

        $this->title = $title;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitleValue()
    {
        $titles = self::getTitles();

        return $titles[$this->title];
    }

    /**
     * {@inheritdoc}
     */
    public static function getTitles()
    {
        return array(
            self::TITLE_MR  => 'fruitware_contact.form.title_mr',
            self::TITLE_MRS => 'fruitware_contact.form.title_mrs',
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function getTitleKeys()
    {
        return array_keys(self::getTitles());
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        $baseArray = parent::toArray();

        return array_merge($baseArray, array(
            'title'     => $this->title,
            'firstName' => $this->firstName,
            'lastName'  => $this->lastName,
            'email'     => $this->email,
            'subject'   => $this->subject,
            'message'   => $this->message,
        ));
    }
}
