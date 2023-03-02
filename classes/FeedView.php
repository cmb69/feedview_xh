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

class FeedView
{
    /**
     * @param string $filename
     * @param string $template
     * @return string
     */
    public function __invoke($filename, $template)
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
        $view = new View($pth["folder"]["plugins"] . "feedview/views/", $plugin_tx["feedview"]);
        return $view->render($template, compact('feed', 'pcf', 'ptx'));
    }
}
