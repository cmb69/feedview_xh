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

use Feedview\Infra\View;
use Feedview\FeedView;
use Feedview\Infra\FeedReader;

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

define('FEEDVIEW_VERSION', "1.0");

/**
 * @param string $class
 * @return void
 */
function Feedview_autoload($class)
{
    global $pth;

    if ($class == 'SimplePie') {
        include_once $pth['folder']['plugins']
            . 'feedview/simplepie/simplepie_1.3.1.compiled.php';
    }
}

/**
 * @param string $filename
 * @param string $template
 * @return string
 */
function feedview($filename, $template = 'default')
{
    global $plugin_cf, $plugin_tx, $pth;
    $handler = new FeedView(
        $plugin_cf["feedview"],
        $plugin_tx["feedview"],
        new FeedReader,
        new View($pth["folder"]["plugins"] . "feedview/views/", $plugin_tx["feedview"])
    );
    return $handler($filename, $template);
}

spl_autoload_register('Feedview_autoload');
