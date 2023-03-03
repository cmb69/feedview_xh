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
use Feedview\Infra\FakeSystemChecker;
use Feedview\Infra\View;
use PHPUnit\Framework\TestCase;

class PluginInfoTest extends TestCase
{
    public function testRendersPluginInfo(): void
    {
        $sut = new PluginInfo(
            "./plugins/feedview/",
            new FakeSystemChecker,
            new View("./views/", XH_includeVar("./languages/en.php", "plugin_tx")["feedview"])
        );
        $response = $sut();
        $this->assertEquals("Feedview 1.1-dev", $response->title());
        Approvals::verifyHtml($response->output());
    }
}
