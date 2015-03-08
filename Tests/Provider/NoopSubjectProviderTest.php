<?php

/*
 * This file is part of the Fruitware\ContactBundle Symfony bundle.
 *
 * (c) Rémi Marseille <marseille.remi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fruitware\ContactBundle\Tests\Provider;

use Fruitware\ContactBundle\Provider\NoopSubjectProvider;

/**
 * Tests NoopSubjectProvider class
 *
 * @author Rémi Marseille <marseille.remi@gmail.com>
 */
class NoopSubjectProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the getSubjects method
     */
    public function testGetSubjects()
    {
        $provider = new NoopSubjectProvider;
        $subjects = $provider->getSubjects();

        $this->assertTrue(is_array($subjects));
        $this->assertCount(0, $subjects);
    }
}
