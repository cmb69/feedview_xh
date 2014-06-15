<?php

/**
 * Testing the feed view.
 *
 * PHP version 5
 *
 * @category  Testing
 * @package   Feedview
 * @author    Christoph M. Becker <cmbecker69@gmx.de>
 * @copyright 2014 Christoph M. Becker <http://3-magi.net>
 * @license   http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @version   SVN: $Id$
 * @link      http://3-magi.net/?CMSimple_XH/Feedview_XH
 */

require_once './classes/Domain.php';
require_once './classes/DataSource.php';
require_once './classes/Presentation.php';

/**
 * Testing the feed view.
 *
 * @category CMSimple_XH
 * @package  Feedview
 * @author   Christoph M. Becker <cmbecker69@gmx.de>
 * @license  http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link     http://3-magi.net/?CMSimple_XH/Feedview_XH
 */
class FeedViewTest extends PHPUnit_Framework_TestCase
{
    /**
     * The test subject.
     *
     * @var Feedview_Controller
     */
    private $_subject;

    /**
     * Sets up the test fixture.
     *
     * @return void
     */
    public function setUp()
    {
        $this->_subject = new Feedview_Controller();
    }

    /**
     * Tests the rendering of the feed head.
     *
     * @return void
     */
    public function testRendersFeedHead()
    {
        $this->assertTag(
            array(
                'tag' => 'h4',
                'child' => array(
                    'tag' => 'a',
                    'attributes' => array('href' => 'http://3-magi.net/'),
                    'content' => '3-magi.net'
                )
            ),
            $this->_subject->renderFeed('./tests/data/3-magi.xml')
        );
    }

    /**
     * Tests that a feed with 32 items is rendered.
     *
     * @return void
     */
    public function testRendersFeedWith32Items()
    {
        $this->assertTag(
            array(
                'tag' => 'ul',
                'attributes' => array('class' => 'feedview_items'),
                'children' => array(
                    'count' => 32
                )
            ),
            $this->_subject->renderFeed('./tests/data/3-magi.xml')
        );
    }

    /**
     * Tests that the feed item head is rendered.
     *
     * @return void
     */
    public function testRendersFeedItemHead()
    {
        $this->assertTag(
            array(
                'tag' => 'li',
                'child' => array(
                    'tag' => 'a',
                    'attributes' => array(
                        'href' => 'http://3-magi.net/?CMSimple_XH/Chess_XH'
                    ),
                    'content' => 'Chess_XH'
                ),
                'parent' => array(
                    'tag' => 'ul',
                    'attributes' => array('class' => 'feedview_items')
                )
            ),
            $this->_subject->renderFeed('./tests/data/3-magi.xml')
        );
    }

    /**
     * Tests that the feed item body is rendered.
     *
     * @return void
     */
    public function testRendersFeedItemBody()
    {
        $this->assertTag(
            array(
                'tag' => 'li',
                'child' => array(
                    'tag' => 'div',
                    'content' => 'Version 1.0beta1 released.'
                ),
                'parent' => array(
                    'tag' => 'ul',
                    'attributes' => array('class' => 'feedview_items')
                )
            ),
            $this->_subject->renderFeed('./tests/data/3-magi.xml')
        );
    }
}

?>
