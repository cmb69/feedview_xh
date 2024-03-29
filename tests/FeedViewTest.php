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
use Feedview\Infra\FakeRequest;
use Feedview\Infra\Url;
use Feedview\Infra\View;
use PHPUnit\Framework\TestCase;

class FeedViewTest extends TestCase
{
    public function testRendersFeed(): void
    {
        $sut = $this->sut();
        $request = new FakeRequest(["url" => new Url("", [])]);
        $response = $sut($request, "irrelevant_url", "feedview");
        Approvals::verifyHtml($response);
    }

    public function testRendersFeedWithSuppliedOffset(): void
    {
        $sut = $this->sut();
        $request = new FakeRequest(["url" => new Url("", ["feedview_start" => ["1" => "1"]])]);
        $response = $sut($request, "irrelevant_url");
        Approvals::verifyHtml($response);
    }

    public function testRendersTwoFeedsWithSuppliedOffsets(): void
    {
        $sut1 = $this->sut(["serial" => 1]);
        $sut2 = $this->sut(["serial" => 2]);
        $request = new FakeRequest(["url" => new Url("", ["feedview_start" => ["2" => "1"]])]);
        $response1 = $sut1($request, "irrelevant_url");
        $response2 = $sut2($request, "irrelevant_url");
        Approvals::verifyHtml($response1 . $response2);
    }

    public function testEnabledCacheStillRendersFeed(): void
    {
        $sut = $this->sut(["conf" => ["cache_enabled" => false]]);
        $request = new FakeRequest(["url" => new Url("", [])]);
        $response = $sut($request, "irrelevant_url", "feedview");
        $this->assertStringEqualsFile(__DIR__ . "/approvals/FeedViewTest.testRendersFeed.approved.html", $response);
    }

    public function testRendersFeedWithOnlyOneItem(): void
    {
        $sut = $this->sut(["conf" => ["default_items" => 1]]);
        $request = new FakeRequest(["url" => new Url("", [])]);
        $response = $sut($request, "irrelevant_url", "feedview");
        Approvals::verifyHtml($response);
    }

    public function testRendersFeedWithOnlyOneItemViaPluginCall(): void
    {
        $sut = $this->sut();
        $request = new FakeRequest(["url" => new Url("", [])]);
        $response = $sut($request, "irrelevant_url", 1, "feedview");
        $this->assertStringEqualsFile(
            __DIR__ . "/approvals/FeedViewTest.testRendersFeedWithOnlyOneItem.approved.html",
            $response
        );
    }

    public function testReportsFailureToParseArguments(): void
    {
        $sut = $this->sut();
        $request = new FakeRequest;
        $response = $sut($request, "irrelevant_url", "custom", 3);
        Approvals::verifyHtml($response);
    }

    public function testReportsFailureToReadFeed(): void
    {
        $sut = $this->sut(["reader" => ["init" => false]]);
        $request = new FakeRequest;
        $response = $sut($request, "irrelevant_url", "feedview");
        Approvals::verifyHtml($response);
    }

    public function testReportsMissingCustomTemplate(): void
    {
        $sut = $this->sut();
        $request = new FakeRequest(["url" => new Url("", [])]);
        $response = $sut($request, "irrelevant_url", "does_not_exist");
        Approvals::verifyHtml($response);
    }

    private function sut($options = []): FeedView
    {
        $text = XH_includeVar("./languages/en.php", "plugin_tx")["feedview"];
        return new FeedView(
            $options["serial"] ?? 1,
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
