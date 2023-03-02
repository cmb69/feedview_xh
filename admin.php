<?php

/**
 * Copyright 2014-2023 Christoph M. Becker
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

use Feedview\Dic;

if (!defined('CMSIMPLE_XH_VERSION')) {
    header('HTTP/1.1 403 Forbidden');
    exit;
}

/**
 * @var string $admin
 * @var string $o
 */

XH_registerStandardPluginMenuItems(false);

if (XH_wantsPluginAdministration("feedview")) {
    $o .= print_plugin_admin("off");
    switch ($admin) {
        case "":
            $o .= Dic::makePluginInfo()()->fire();
            break;
        default:
            $o .= plugin_admin_common();
    }
}
