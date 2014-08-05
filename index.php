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
 * Prevent direct access and usage from unsupported CMSimple_XH versions.
 */
if (!defined('CMSIMPLE_XH_VERSION')
    || strpos(CMSIMPLE_XH_VERSION, 'CMSimple_XH') !== 0
    || version_compare(CMSIMPLE_XH_VERSION, 'CMSimple_XH 1.6', 'lt')
) {
    header('HTTP/1.1 403 Forbidden');
    header('Content-Type: text/plain; charset=UTF-8');
    die(<<<EOT
Feedview_XH detected an unsupported CMSimple_XH version.
Uninstall Feedview_XH or upgrade to a supported CMSimple_XH version!
EOT
    );
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
