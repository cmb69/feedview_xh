<?php

/**
 * Testing the views.
 *
 * PHP version 5
 *
 * @category  Testing
 * @package   Feedview
 * @author    Christoph M. Becker <cmbecker69@gmx.de>
 * @copyright 2014 Christoph M. Becker <http://3-magi.net/>
 * @license   http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @version   SVN: $Id$
 * @link      http://3-magi.net/?CMSimple_XH/Feedview_XH
 */

require_once './vendor/autoload.php';
require_once '../../cmsimple/functions.php';
require_once './classes/View.php';

use org\bovigo\vfs\vfsStreamWrapper;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStream;

/**
 * Testing the views.
 *
 * @category Testing
 * @package  Feedview
 * @author   Christoph M. Becker <cmbecker69@gmx.de>
 * @license  http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link     http://3-magi.net/?CMSimple_XH/Feedview_XH
 */
class ViewTest extends PHPUnit_Framework_TestCase
{
    /**
     * The template contents.
     */
    const TEMPLATE = '<p><?php echo $foo?></p>';

    /**
     * The test subject.
     *
     * @var Feedview_View
     */
    protected $subject;

    /**
     * Sets up the test fixture.
     *
     * @return void
     */
    public function setUp()
    {
        $this->setUpFileSystem();
        $this->subject = Feedview_View::make('test', ['foo' => 'bar']);
    }

    /**
     * Sets up the file system mocks.
     *
     * @return void
     *
     * @global array The paths of system files and folders.
     */
    protected function setUpFileSystem()
    {
        global $pth;

        vfsStreamWrapper::register();
        vfsStreamWrapper::setRoot(new vfsStreamDirectory('test'));
        $pth = ['folder' => ['plugins' => vfsStream::url('test/')]];
        mkdir(vfsStream::url('test/feedview/views/'), 0777, true);
        file_put_contents(
            vfsStream::url('test/feedview/views/test.php'), self::TEMPLATE
        );
    }

    /**
     * Tests that a missing template is reported.
     *
     * @return void
     */
    public function testMissingTemplateIsReported()
    {
        $subject = Feedview_View::make('foo', []);
        $messageMock = new PHPUnit_Extensions_MockFunction('XH_message', $subject);
        $messageMock->expects($this->once())->with('fail');
        $subject->render();
    }

    /**
     * Tests that the template is rendered correctly.
     *
     * @return void
     */
    public function testTemplateIsRenderedCorrectly()
    {
        $this->assertEquals('<p>bar</p>', $this->subject->render());
    }
}

?>
