<?php

/*
 * This file is part of the Fruitware\ContactBundle Symfony bundle.
 *
 * (c) Coroliov Oleg <coroliov.o@fruitware.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fruitware\ContactBundle\Tests\Provider;

use Fruitware\ContactBundle\Provider\NoopSubjectProvider;

/**
 * Tests NoopSubjectProvider class
 *
 * @author Coroliov Oleg <coroliov.o@fruitware.ru>
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
