<?php

/*
 * This file is part of the Mremi\ContactBundle Symfony bundle.
 *
 * (c) Rémi Marseille <marseille.remi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mremi\ContactBundle\Model;

/**
 * BaseContact interface
 *
 * @author Thomas Kekeisen <thomas.kekeisen@socialbit.de>
 */
class BaseContact implements BaseContactInterface
{
    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setCreatedAt(new \DateTime);
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array(
            'createdAt' => $this->createdAt->format('c'),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function fromArray(array $data)
    {
        foreach ($data as $property => $value) {
            $method = sprintf('set%s', ucfirst($property));

            $this->$method('createdAt' === $property ? new \DateTime($value) : $value);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize($this->toArray());
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($data)
    {
        $this->fromArray(unserialize($data));
    }
}
