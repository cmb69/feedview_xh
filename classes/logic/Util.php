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

class Util
{
    /**
     * @param array<scalar> $args
     * @param array{int,string} $defaults
     * @return array{int,string}|null
     */
    public static function parseArgs(array $args, array $defaults): ?array
    {
        if (count($args) === 0) {
            return [$defaults[0], $defaults[1]];
        } elseif (count($args) === 1 && is_string($args[0])) {
            return [$defaults[0], $args[0]];
        } elseif (count($args) === 2 && is_int($args[0]) && is_string($args[1])) {
            return [$args[0], $args[1]];
        }
        return null;
    }
}
