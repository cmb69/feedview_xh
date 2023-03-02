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

namespace Feedview;

use Feedview\Infra\View;
use Feedview\FeedView;
use Feedview\Infra\FeedReader;

class Dic
{
    public static function makeFeedView(): FeedView
    {
        global $plugin_cf, $plugin_tx, $pth;

        include_once $pth["folder"]["plugins"] . "feedview/simplepie/SimplePie.compiled.php";
        return new FeedView(
            $plugin_cf["feedview"],
            $plugin_tx["feedview"],
            new FeedReader,
            new View($pth["folder"]["plugins"] . "feedview/views/", $plugin_tx["feedview"])
        );
    }
}
