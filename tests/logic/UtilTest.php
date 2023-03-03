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

namespace Feedview\Logic;

use PHPUnit\Framework\TestCase;

class UtilTest extends TestCase
{
    /** @dataProvider parsesArgsData */
    public function testParsesArgs($args, $expected): void
    {
        $defaults = [0, "feedview"];
        $actual = Util::parseArgs($args, $defaults);
        $this->assertEquals($expected, $actual);
    }

    public function parsesArgsData(): array
    {
        return [
            "none" => [[], [0, "feedview"]],
            "int" => [[17], [17, "feedview"]],
            "string" => [["custom"], [0, "custom"]],
            "int_string" => [[17, "custom"], [17, "custom"]],
            "string_string" => [["foo", "bar"], null],
            "three" => [[3, "custom", "extra"], null],
        ];
    }
}
