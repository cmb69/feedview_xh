<?php

/**
 * The controllers.
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

/**
 * The controllers.
 *
 * @category CMSimple_XH
 * @package  Feedview
 * @author   Christoph M. Becker <cmbecker69@gmx.de>
 * @license  http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link     http://3-magi.net/?CMSimple_XH/Feedview_XH
 */
class Feedview_Controller
{
    /**
     * Dispatch according to the request.
     *
     * @return void
     *
     * @global string Whether the plugin administration is requested.
     */
    public function dispatch()
    {
        global $feedview;

        if (XH_ADM && isset($feedview) && $feedview == 'true') {
            $this->_handleAdministration();
        }
    }

    /**
     * Handles the administration.
     *
     * @return void
     *
     * @global string The value of the <var>admin</var> GP parameter.
     * @global string The value of the <var>action</var> GP parameter.
     * @global string The HTML of the contents area.
     */
    private function _handleAdministration()
    {
        global $admin, $action, $o;

        $o .= print_plugin_admin('off');
        switch ($admin) {
        case '':
            $o .= $this->renderInfo();
            break;
        default:
            $o .= plugin_admin_common($action, $admin, 'feedview');
        }
    }

    /**
     * Renders a feed.
     *
     * @param string $filename A feed filename.
     * @param string $template A template name.
     *
     * @return string (X)HTML.
     *
     * @global array The paths of system files and folders.
     * @global array The configuration of the plugins.
     * @global array The localization of the plugins.
     */
    public function renderFeed($filename, $template)
    {
        global $pth, $plugin_cf, $plugin_tx;

        $pcf = $plugin_cf['feedview'];
        $ptx = $plugin_tx['feedview'];
        $feed = new SimplePie();
        if ($pcf['cache_enabled']) {
            $feed->set_cache_location(
                $pth['folder']['plugins'] . 'feedview/cache/'
            );
        } else {
            $feed->enable_cache(false);
        }
        $feed->set_feed_url($filename);
        $feed->init();
        return Feedview_View::make($template, compact('feed', 'pcf', 'ptx'))
            ->render();
    }

    /**
     * Renders the info view.
     *
     * @return string (X)HTML.
     */
    public function renderInfo()
    {
        return '<h1>Feedview</h1>'
            . $this->_renderIcon()
            . '<p>Version: ' . FEEDVIEW_VERSION . '</p>'
            . $this->_renderCopyright() . $this->_renderLicense();
    }

    /**
     * Renders the plugin icon.
     *
     * @return (X)HTML.
     *
     * @global array The paths of system files and folders.
     * @global array The localization of the plugins.
     */
    private function _renderIcon()
    {
        global $pth, $plugin_tx;

        return tag(
            'img src="' . $pth['folder']['plugins'] . 'feedview/feedview.png"'
            . ' class="feedview_icon" alt="' . $plugin_tx['feedview']['alt_icon']
            . '"'
        );
    }

    /**
     * Renders the copyright info.
     *
     * @return (X)HTML.
     */
    private function _renderCopyright()
    {
        return <<<EOT
<p>Copyright &copy; 2014
    <a href="http://3-magi.net/" target="_blank">Christoph M. Becker</a>
</p>
EOT;
    }

    /**
     * Renders the license info.
     *
     * @return (X)HTML.
     */
    private function _renderLicense()
    {
        return <<<EOT
<p class="feedview_license">This program is free software: you can
redistribute it and/or modify it under the terms of the GNU General Public
License as published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.</p>
<p class="feedview_license">This program is distributed in the hope that it will
be useful, but <em>without any warranty</em>; without even the implied warranty
of <em>merchantability</em> or <em>fitness for a particular purpose</em>. See
the GNU General Public License for more details.</p>
<p class="feedview_license">You should have received a copy of the GNU
General Public License along with this program. If not, see <a
href="http://www.gnu.org/licenses/" target="_blank">http://www.gnu.org/licenses/</a>.
</p>
EOT;
    }
}

?>
