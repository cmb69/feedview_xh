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

namespace Feedview\Infra;

use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    /** @dataProvider urlData */
    public function testUrl(?string $query, Url $expected): void
    {
        $sut = new FakeRequest(["su" => "FeedView", "server" => ["QUERY_STRING" => $query]]);
        $url = $sut->url();
        $this->assertEquals($expected, $url);
    }

    public function urlData(): array
    {
        return [
            "su" => ["FeedView", new Url("FeedView", [])],
            "su+params" => ["Feeview&foo=bar", new Url("FeedView", ["foo" => "bar"])],
        ];
    }
}