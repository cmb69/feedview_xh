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
    public function testRendersFeed(): void
    {
        $sut = $this->sut();
        $response = $sut("irrelevant_url", "default");
        Approvals::verifyHtml($response);
    }

    public function testEnabledCacheStillRendersFeed(): void
    {
        $sut = $this->sut(["conf" => ["cache_enabled" => false]]);
        $response = $sut("irrelevant_url", "default");
        $this->assertStringEqualsFile(__DIR__ . "/approvals/FeedViewTest.testRendersFeed.approved.html", $response);
    }

    public function testReportsFailureToReadFeed(): void
    {
        $sut = $this->sut(["reader" => ["init" => false]]);
        $response = $sut("irrelevant_url", "default");
        Approvals::verifyHtml($response);
    }

    public function testReportsMissingCustomTemplate(): void
    {
        $sut = $this->sut();
        $response = $sut("irrelevant_url", "does_not_exist");
        Approvals::verifyHtml($response);
    }

    private function sut($options = []): FeedView
    {
        $text = XH_includeVar("./languages/en.php", "plugin_tx")["feedview"];
        return new FeedView(
            "./cache/",
            $this->conf($options["conf"] ?? []),
            new FakeFeedReader($options["reader"] ?? []),
            new View("./views/", $text
        ));
    }

    private function conf($options = []): array
    {
        $conf = XH_includeVar("./config/config.php", "plugin_cf")["feedview"];
        $text = XH_includeVar("./languages/en.php", "plugin_tx")["feedview"];
        $conf["format_date"] = $text["format_date"];
        return $options + $conf;
    }
}
