<?php

/**
 * Copyright 2023 Christoph M. Becker
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

use ApprovalTests\Approvals;
use Feedview\Infra\FakeFeedReader;
use Feedview\Infra\View;
use PHPUnit\Framework\TestCase;

class FeedViewTest extends TestCase
{
    public function testRendersFeedWithoutItems(): void
    {
        global $pth;
        $pth = ["folder" => ["plugins" => ""]];
        $conf = XH_includeVar("./config/config.php", "plugin_cf")["feedview"];
        $text = XH_includeVar("./languages/en.php", "plugin_tx")["feedview"];
        $sut = new FeedView($conf, $text, new FakeFeedReader, new View("./views/", $text));
        $response = $sut("irrelevant_url", "default");
        Approvals::verifyHtml($response);
    }
}
