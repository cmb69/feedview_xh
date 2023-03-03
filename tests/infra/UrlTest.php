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

class UrlTest extends TestCase
{
    /** @dataProvider urlYieldsCorrectStringData */
    public function testUrlYieldsCorrectString(array $params, string $expected): void
    {
        $url = new Url("FeedView", $params);
        $this->assertEquals($expected, $url->relative());
    }

    public function urlYieldsCorrectStringData(): array
    {
        return [
            "no_params" => [[], "http://example.com/?FeedView"],
            "simple_param" => [["foo" => "bar"], "http://example.com/?FeedView&foo=bar"],
            "valueless" => [["print" => ""], "http://example.com/?FeedView&print"],
            "mixed" => [["normal" => "", "foo" => "bar"], "http://example.com/?FeedView&normal&foo=bar"],
            "list" => [["foo" => ["bar", "baz"]], "http://example.com/?FeedView&foo%5B0%5D=bar&foo%5B1%5D=baz"],
            "dict" => [["foo" => ["bar" => "baz"]], "http://example.com/?FeedView&foo%5Bbar%5D=baz"],
        ];
    }

    public function testEmptyQueryStringDoesNotHaveQuestionMark(): void
    {
        $url = new Url("", []);
        $this->assertEquals("http://example.com/", $url->relative());
    }

    /** @dataProvider withOffsetData */
    public function testWithOffset(array $params, array $withs, Url $expected): void
    {
        $url = new Url("", $params);
        foreach ($withs as $with) {
            [$serial, $offset] = $with;
            $url = $url->withOffset($serial, $offset);
        }
        $this->assertEquals($expected, $url);
    }

    public function withOffsetData(): array
    {
        return [
            "single" => [[], [[1, 3]], new Url("", ["feedview_start" => ["1" => "3"]])],
            "multi" => [[], [[1, 3], [2, 4]], new Url("", ["feedview_start" => ["1" => "3", "2" => "4"]])],
            "default" => [[], [[1, 0]], new Url("", [])],
            "replace" => [
                ["feedview_start" => ["2" => "3"]],
                [[2, 4]],
                new Url("", ["feedview_start" => ["2" => "4"]])
            ],
            "add" => [
                ["feedview_start" => ["1" => "3"]],
                [[2, 4]],
                new Url("", ["feedview_start" => ["1" => "3", "2" => "4"]]),
            ]
        ];
    }

    public function testParams(): void
    {
        $url = new Url("FeedView", ["foo" => "bar", "baz" => ["foo", "bar"]]);
        $this->assertNull($url->param("bar"));
        $this->assertEquals("bar", $url->param("foo"));
        $this->assertEquals(["foo", "bar"], $url->param("baz"));
    }
}
