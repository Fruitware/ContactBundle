<?php

/*
 * This file is part of the Fruitware\ContactBundle Symfony bundle.
 *
 * (c) Rémi Marseille <marseille.remi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fruitware\ContactBundle\Provider;

/**
 * Noop subject provider class
 *
 * @author Rémi Marseille <marseille.remi@gmail.com>
 */
class NoopSubjectProvider implements SubjectProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getSubjects()
    {
        return array();
    }
}
