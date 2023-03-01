<?php

/**
 * Copyright 2014 Christoph M. Becker
 *
 * This file is part of Feedview_XH.
 *
 * Feedview_XH is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Feedview_XH is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Feedview_XH.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Feedview;

use SimplePie;

class Controller
{
    /**
     * @return void
     */
    public function dispatch()
    {
        if (XH_ADM) {
            XH_registerStandardPluginMenuItems(false);
            if ($this->isAdministrationRequested()) {
                $this->handleAdministration();
            }
        }
    }

    /**
     * @return bool
     */
    protected function isAdministrationRequested()
    {
        global $feedview;

        return function_exists('XH_wantsPluginAdministration')
            && XH_wantsPluginAdministration('feedview')
            || isset($feedview) && $feedview == 'true';
    }

    /**
     * @return void
     */
    private function handleAdministration()
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
     * @param string $filename
     * @param string $template
     * @return string
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
        if (!$feed->init()) {
            return XH_message('fail', $ptx['error_read_feed'], $filename);
        }
        return View::make($template, compact('feed', 'pcf', 'ptx'))
            ->render();
    }

    /**
     * @return string
     */
    public function renderInfo()
    {
        return '<h1>Feedview</h1>'
            . $this->renderIcon()
            . '<p>Version: ' . FEEDVIEW_VERSION . '</p>'
            . $this->renderCopyright() . $this->renderLicense();
    }

    /**
     * @return string
     */
    private function renderIcon()
    {
        global $pth, $plugin_tx;

        return tag(
            'img src="' . $pth['folder']['plugins'] . 'feedview/feedview.png"'
            . ' class="feedview_icon" alt="' . $plugin_tx['feedview']['alt_icon']
            . '"'
        );
    }

    /**
     * @return string
     */
    private function renderCopyright()
    {
        return <<<EOT
<p>Copyright &copy; 2014
    <a href="http://3-magi.net/" target="_blank">Christoph M. Becker</a>
</p>
EOT;
    }

    /**
     * @return string
     */
    private function renderLicense()
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
