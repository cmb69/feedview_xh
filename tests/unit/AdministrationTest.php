<?php

/**
 * Testing the general plugin administration.
 *
 * PHP version 5
 *
 * @category  CMSimple_XH
 * @package   Feedview
 * @author    Christoph M. Becker <cmbecker69@gmx.de>
 * @copyright 2014 Christoph M. Becker <http://3-magi.net>
 * @license   http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @version   SVN: $Id$
 * @link      http://3-magi.net/?CMSimple_XH/Feedview_XH
 */

require_once './vendor/autoload.php';
require_once '../../cmsimple/adminfuncs.php';
require_once './classes/Presentation.php';

/**
 * Testing the general plugin administration.
 *
 * @category CMSimple_XH
 * @package  Feedview
 * @author   Christoph M. Becker <cmbecker69@gmx.de>
 * @license  http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link     http://3-magi.net/?CMSimple_XH/Feedview_XH
 */
class AdministrationTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests the stylesheet administration.
     *
     * @return void
     *
     * @global string Whether the plugin administration is requested.
     * @global string The value of the <var>admin</var> GP parameter.
     * @global string The value of the <var>action</var> GP parameter.
     */
    public function testStylesheet()
    {
        global $feedview, $admin, $action;

        $this->_defineConstant('XH_ADM', true);
        $feedview = 'true';
        $admin = 'plugin_stylesheet';
        $action = 'plugin_text';
        $subject = new Feedview_Controller();
        $printPluginAdmin = new PHPUnit_Extensions_MockFunction(
            'print_plugin_admin', $subject
        );
        $printPluginAdmin->expects($this->once())->with('off');
        $pluginAdminCommon = new PHPUnit_Extensions_MockFunction(
            'plugin_admin_common', $subject
        );
        $pluginAdminCommon->expects($this->once())
            ->with($action, $admin, 'feedview');
        $subject->dispatch();
    }

    /**
     * (Re)defines a constant.
     *
     * @param string $name  A name.
     * @param string $value A value.
     *
     * @return void
     */
    private function _defineConstant($name, $value)
    {
        if (!defined($name)) {
            define($name, $value);
        } else {
            runkit_constant_redefine($name, $value);
        }
    }
}

?>