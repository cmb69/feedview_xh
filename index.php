<?php

/**
 * main ;)
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

/*
 * Prevent direct access.
 */
if (!defined('CMSIMPLE_XH_VERSION')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

/**
 * The presentation layer.
 */
require_once $pth['folder']['plugin_classes'] . 'Presentation.php';

/**
 * The plugin version.
 */
define('FEEDVIEW_VERSION', '@FEEDVIEW_VERSION@');

/**
 * Renders a feed.
 *
 * @param string $filename A feed filename.
 *
 * @return string (X)HTML.
 */
function feedview($filename)
{
    global $_Feedview_controller;

    return $_Feedview_controller->renderFeed($filename);
}

/**
 * The plugin controller.
 */
$_Feedview_controller = new Feedview_Controller();
$_Feedview_controller->dispatch();

?>
